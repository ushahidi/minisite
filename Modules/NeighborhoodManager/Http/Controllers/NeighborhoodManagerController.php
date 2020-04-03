<?php

namespace Modules\NeighborhoodManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Searchable\Search;
use Spatie\Searchable\ModelSearchAspect;

use Modules\NeighborhoodManager\Invite;
use App\User;
use Modules\NeighborhoodManager\Neighborhood;
use Modules\Minisite\Minisite;

use Illuminate\Support\Facades\Validator;

class NeighborhoodManagerController extends Controller
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
        $neighborhood = Auth::user()->neighborhood;
        if (!$neighborhood) {
            abort(404, 'You don\'t belong to any neighborhood yet');
        }
        return view('neighborhood.show', ['neighborhood' => Neighborhood::findOrFail($neighborhood->id)]);
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

    
    public function searchPage(Request $request)
    {
        return view('search');
    }


    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Neighborhood::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('city')
                    ->addSearchableAttribute('state')
                    ->addSearchableAttribute('country')
                    ->addSearchableAttribute('name'); // only return results that exactly match the e-mail address
            }
        )->search($request->input('query'));
        return view('search', compact('searchResults'));
    }

}
