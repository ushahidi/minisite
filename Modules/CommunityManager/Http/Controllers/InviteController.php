<?php

namespace Modules\CommunityManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\CommunityManager\Invite;
use Modules\CommunityManager\Community;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class InviteController extends Controller
{

    protected function generate($communityId, Request $request) {
        $generatedBy = Auth::user()->id;
        $token = (string) Str::uuid();
        $canGenerateLink = Community::find($communityId)->captain_id === $generatedBy;
        $invite = Invite::create([
            'token' => $token,
            'generated_by' => $generatedBy,
            'community_id' => $communityId
        ]);
        $invite->save();
        return redirect()->route(
            'communityShow',
            ['id' => $communityId] )->with( ['token' => $invite->token, 'id' => $communityId]
        );
    }
}
