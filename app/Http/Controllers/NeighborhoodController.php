<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Invite;
use App\User;
use App\Neighborhood;
use App\Minisite;

use Illuminate\Support\Facades\Validator;


class NeighborhoodController extends Controller
{

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    protected function create()
    {
        $user = Auth::user();

        return view('neighborhood.create', ['user' => $user]);
    }

    /**
     * Show the neighborhood for the given user.
     *
     * @param  int  $id
     * @return View
     */
    protected function show($id = null)
    {
        if (!$id) {
            $neighborhood = Auth::user()->neighborhood;
            $id = $neighborhood->id;
        }
        return view('neighborhood.show', ['neighborhood' => Neighborhood::findOrFail($id)]);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
        ]);
        $neighborhood = Neighborhood::create([
            'name' => $validatedData['name'],
            'city' => $validatedData['city'],
            'state' => $validatedData['state'],
            'country' => $validatedData['country'],
            'captain_id' => Auth::user()->id
        ]);
        
        $neighborhood->save();
        $user = User::findOrFail(Auth::user()->id)->update(['neighborhood_id' => $neighborhood->id]);
        $minisite = Minisite::create([
            'title' => $neighborhood->name, 
            'neighborhood_id' => $neighborhood->id,
            'visibility' => 'public'
        ])->save();
        return view('neighborhood.show', ['neighborhood' => $neighborhood]);
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
