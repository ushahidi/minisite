<?php

namespace Modules\CommunityManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Searchable\Search;
use Spatie\Searchable\ModelSearchAspect;

use Modules\CommunityManager\Invite;
use App\User;
use Modules\CommunityManager\Community;
use Modules\CommunityManager\CommunityLocation;

use Modules\CommunityManager\UserCommunity;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\Rule;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;

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
     * Show the community for the given user.
     *
     * @param  int  $id
     * @return View
     */
    protected function show($id = null)
    {
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

        $community->save();

        $user = UserCommunity::create(
            [
                'community_id' => $community->id,
                'user_id' => Auth::user()->id,
                'role' => UserCommunity::ROLE_OWNER
            ]
        )->save();
        return redirect()->route(
            'getLocationOptions', 
            ['community' => $community, 'location_string' => $request->input('location_string')]
        );
        // return redirect()->route(
        //     'minisite.location',
        //     ['community' => $community]
        // );
    }

    protected function getLocationOptions(Community $community, Request $request) {
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

        // return redirect()->route(
        //     'minisite.setLocation',
        //     ['community' => $community]
        // )->with(["locations" => $result])
        // return $result;
    }
    protected function storeLocation(Community $community, Request $request) {
        $locationJSON = json_decode($request->input("location"));
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
        return redirect()->route(
            'register'
        )->with( ['token' => $token]);
    }

    
}
