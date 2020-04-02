<?php

namespace Modules\NeighborhoodManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\NeighborhoodManager\Invite;
use Modules\NeighborhoodManager\Neighborhood;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class InviteController extends Controller
{

    protected function generate($neighborhoodId, Request $request) {
        $generatedBy = Auth::user()->id;
        $token = (string) Str::uuid();
        $canGenerateLink = Neighborhood::find($neighborhoodId)->captain_id === $generatedBy;
        $invite = Invite::create([
            'token' => $token,
            'generated_by' => $generatedBy,
            'neighborhood_id' => $neighborhoodId
        ]);
        $invite->save();
        return redirect()->route(
            'neighborhoodShow',
            ['id' => $neighborhoodId] )->with( ['token' => $invite->token, 'id' => $neighborhoodId]
        );
    }
}
