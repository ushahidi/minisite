<?php

namespace Modules\Minisite\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Minisite\Models\Invite;
use Modules\Minisite\Models\Community;
use Modules\Minisite\Models\UserCommunity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInviteEmail;

class InviteController extends Controller
{
    
    protected function inviteMembers(Community $community) {
        return view('minisite::members.invite', ['community' => $community]);
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
                    new SendInviteEmail(
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
