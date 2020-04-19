<?php

namespace Modules\Minisite\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;

use Illuminate\Support\Facades\Auth;

use Modules\Minisite\Models\Invite;
use App\User;
use Modules\Minisite\Models\Community;
use Modules\Minisite\Models\UserCommunity;


class MembershipManagerController extends Controller
{

    protected function members(Community $community) {
        $this->authorize('update', $community);

        return view('minisite::members.view', ['community' => $community, 'members' => $community->members]);
    }
    
    protected function member(Community $community, User $user) {
        $this->authorize('update', $community);

        return view('minisite::members.show', ['community' => $community, 'member' => $user]);
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
}
