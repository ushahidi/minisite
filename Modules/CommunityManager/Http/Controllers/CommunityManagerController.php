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
use Modules\CommunityManager\UserCommunity;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\Rule;
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
            'communityBlocksEdit',
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
