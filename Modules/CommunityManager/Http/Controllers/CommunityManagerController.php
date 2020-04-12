<?php

namespace Modules\CommunityManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Searchable\Search;
use Spatie\Searchable\ModelSearchAspect;

use Modules\CommunityManager\Invite;
use App\User;
use Modules\CommunityManager\Community;
use Modules\CommunityManager\CommunityLocation;
use Modules\BlockManager\Block;
use Modules\BlockManager\BlockTypeFields;
use Modules\CommunityManager\UserCommunity;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\Rule;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;
use App\Mail\SendSiteEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class CommunityManagerController extends Controller
{

    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function all()
    {
        $user = Auth::user();
        return view('communitymanager::index', ['communities' => $user->communities, 'isLoggedIn' => !!$user]);
    }
    
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    protected function create()
    {
        $user = Auth::user();

        return view('communitymanager::community.create', ['user' => $user]);
    }

    /**
     * Edit the community settings
     *
     * @param  int  $id
     * @return View
     */
    protected function edit(Community $community)
    {
        $this->authorize('update', $community);

        $user = Auth::user();
        return view('communitymanager::community.edit', ['user' => $user, 'community' => $community]);
    }
    /**
     * Show the community for the given user.
     *
     * @param  int  $id
     * @return View
     */
    protected function show($id = null)
    {
        $this->authorize('view', $community);

        $community = Auth::user()->community;
        if (!$community) {
            abort(404, 'You don\'t belong to any community yet');
        }
        return view('communitymanager::community.show', ['community' => Community::findOrFail($community->id)]);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function update(Request $request, Community $community)
    {
        $this->authorize('update', $community);

        //[ 'visibility', 'type', 'location_id', 'deployment_id'];
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'welcome' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'visibility' => ['required', 'string',  Rule::in([Community::VISIBILITY_COMMUNITY, Community::VISIBILITY_PUBLIC]),],
        ]);

        $community->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'welcome' => $validatedData['welcome'],
            'visibility' => $validatedData['visibility'],
            'type' => Community::TYPE_NEIGHBORHOOD
        ]);

        // find the page header block and update it, since that's what users expect if they change the welcome and description :shrugs:
        $pageHeaderBlock = Block::where(['community_id' => $community->id])->where(['type' => 'Page header'])->first();
        $title = BlockTypeFields::where(['block_type' => 'Page header'])->where(['name' => 'Title'])->first();
        $description = BlockTypeFields::where(['block_type' => 'Page header'])->where(['name' => 'Description'])->first();

        $blockContent = [
            $title->id => $validatedData['welcome'],
            $description->id => $validatedData['description']
        ];
        if (!$pageHeaderBlock) {    
            Block::create([
                'content' => $blockContent,
                'community_id' => $community->id,
                'name' => 'Page header',
                'description' => null,
                'type' => 'Page header',
                'visibility' => $community->visibility,
                'position' => 1,
                'enabled' => 1,
            ])->save();
        } else {
            $pageHeaderBlock->update([
                'content' => $blockContent,
            ]);    
        }
        
        return redirect()->route(
            'getLocationOptions', 
            ['community' => $community, 'location_string' => $request->input('location_string')]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function store(Request $request)
    {

        //[ 'visibility', 'type', 'location_id', 'deployment_id'];
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'welcome' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'visibility' => ['required', 'string',  Rule::in([Community::VISIBILITY_COMMUNITY, Community::VISIBILITY_PUBLIC]),],
        ]);

        $community = Community::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'welcome' => $validatedData['welcome'],
            'visibility' => $validatedData['visibility'],
            'type' => Community::TYPE_NEIGHBORHOOD
        ]);

        $title = BlockTypeFields::where(['block_type' => 'Page header'])->where(['name' => 'Title'])->first();
        $description = BlockTypeFields::where(['block_type' => 'Page header'])->where(['name' => 'Description'])->first();

        $community->save();

        $user = UserCommunity::create(
            [
                'community_id' => $community->id,
                'user_id' => Auth::user()->id,
                'role' => UserCommunity::ROLE_OWNER
            ]
        )->save();
        $blockContent = [
            $title->id => $validatedData['welcome'],
            $description->id => $validatedData['description']
        ];
        Block::create([
            'content' => $blockContent,
            'community_id' => $community->id,
            'name' => 'Page header',
            'description' => null,
            'type' => 'Page header',
            'visibility' => $community->visibility,
            'position' => 1,
            'enabled' => 1,
        ])->save();

        return redirect()->route(
            'getLocationOptions', 
            ['community' => $community, 'location_string' => $request->input('location_string')]
        );
    }

    protected function getLocationOptions(Community $community, Request $request) {
        $this->authorize('update', $community);
        if (!$request->input('location_string')) {
            return view('communitymanager::community.set-location', ['community' => $community, 'locations' => []]);
        }
        $location_string = $request->input('location');
        $httpClient = new \Http\Adapter\Guzzle6\Client();
        $provider = new \Geocoder\Provider\Nominatim\Nominatim($httpClient,"https://nominatim.openstreetmap.org", "COVID19 Mahallah response", "");
        $geocoder = new \Geocoder\StatefulGeocoder($provider, 'en');
        $results = $geocoder->geocodeQuery(
            GeocodeQuery::create($request->input('location_string'))
        );

        $locations = [];

        foreach($results as $result) {
            $geoCoderBase = $result->toArray();
            $nominatim = [
                'displayName' => $result->getDisplayName(),
                'category' => $result->getCategory(),
                'type' => $result->getType(),
                'osmId' => $result->getOSMId()
            ];
            $locations[] = array_merge($geoCoderBase, $nominatim);
        }
        return view('communitymanager::community.set-location', ['community' => $community, 'locations' => $locations]);
    }

    protected function storeLocation(Community $community, Request $request) {
        $this->authorize('update', $community);
        $locationJSON = json_decode($request->input("location"));
        if (!$locationJSON) {
            return view('communitymanager::community.set-location', ['community' => $community, 'locations' => []]);
        }
        $communityLocation = CommunityLocation::create(
            [
                //we save the raw json, because we may need some of this information later on :) 
                'location_info' => $request->input("location"),
                // punta del este is listed as boundary, not neighborhood, for instance,
                // so display name is our best shot here for search
                'display_name' => $locationJSON->displayName,
                'locality' => $locationJSON->locality,
                'postal_code' => $locationJSON->postalCode,
                'country'       => $locationJSON->country,
                'location_source' => CommunityLocation::SOURCE_USER_OSM,
                'city'  => null, //left blank until I figure out admin levels correctly            
                'state' => null, //left blank until I figure out admin levels correctly            
            ]
        );
        $communityLocation->save();
        $community->location_id = $communityLocation->id;
        $community->save();
        return redirect()->route(
            'minisite.admin',
            ['community' => $community]
        );
    }
    public function joinFromInvite($token) {
        $invite = Invite::where('token', $token)->first();

        if ($invite->claimed) {
            return abort(403, "The invitation link is invalid or has expired.");
        }
        $user = User::where(['email' => $invite->email])->first();
        $authUser = Auth::user();
        if ($authUser && $user && $user->id === $authUser->id) {
            $community = Community::where(['id' => $invite->community_id])->first();
            UserCommunity::create([
                'user_id' => $user->id,
                'community_id' => $community->id,
                'role' => $invite->role
            ]);
            return redirect()->route(
                'minisite.admin', ['community' => $community]
            )->with( ['token' => $token]);
        } else if ($authUser) {
            abort(401, "You are not authorized to accept this invite.");
        } else {
            return redirect()->route(
                'register'
            )->with( ['token' => $token]);
        }
        
    }

    protected function members(Community $community) {
        $this->authorize('update', $community);

        return view('communitymanager::members.view', ['community' => $community, 'members' => $community->members]);
    }
    
    protected function member(Community $community, User $user) {
        $this->authorize('update', $community);

        return view('communitymanager::members.show', ['community' => $community, 'member' => $user]);
    }

    protected function updateMember(Community $community, User $user, Request $request) {
        $this->authorize('update', $community);

        if ($request->input('admin') && $request->input('admin') === 'on') {
            $userCommunity = $user->getCommunityRelation($community);
            $userCommunity->role = UserCommunity::ROLE_ADMIN;
            $userCommunity->update();
        } else {
            $userCommunity = $user->getCommunityRelation($community);
            $userCommunity->role = UserCommunity::ROLE_MEMBER;
            $userCommunity->update();
        }
            
        return redirect()->route(
            'community.members', ['community' => $community]
        );
    }

    protected function inviteMembers(Community $community) {
        return view('communitymanager::members.invite', ['community' => $community]);

    }
    //@todo make it async email
    protected function sendInvites(Community $community, Request $request) {
        $this->authorize('update', $community);

        $user = Auth::user();
        if (!$community->owner($user)){
            abort(401);
        }
        $validatedData = $request->validate([
            'emails' => ['required', 'string'],
            'message' => ['required', 'string', 'max:255']
        ]);
        $emails = explode(",", $validatedData['emails']);
        foreach ($emails as $email) {
            $token = (string) Str::uuid();
            $invite = Invite::create([
                'role' => UserCommunity::ROLE_MEMBER,
                'token' => $token,
                'email' => trim($email),
                'generated_by' => $user->id,
                'community_id' => $community->id
            ]);
            $invite->save();
            Mail::to(trim($email))
                ->send(
                    new SendSiteEmail(
                        $request->input('email'),
                        $request->input('message'),
                        route('joinFromInvite', ['token' => $token])
                    )
                );
        }
        return redirect()->route(
            'community.members', ['community' => $community]
        );
    }
}
