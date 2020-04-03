<?php

namespace Modules\MahallahLanding\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Spatie\Searchable\Search;
use Spatie\Searchable\ModelSearchAspect;

use App\User;
use Modules\NeighborhoodManager\Neighborhood;
use Modules\Minisite\Minisite;

class MahallahLandingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        return view(
                'mahallahlanding::welcome', 
                [
                    'neighborhood' => $user ? $user->neighborhood : null,  
                    'activeCommunities' => $this->activeCommunities(),
                    'isLoggedIn' => !!$user
                ]);
    }
    
    public function searchPage(Request $request)
    {
        return view('mahallahlanding::search');
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
        return view('mahallahlanding::search', compact('searchResults'));
    }
    
    private function activeCommunities() {
        $communities = \Modules\NeighborhoodManager\Neighborhood::orderBy('created_at', 'desc')
               ->take(5)
               ->get();
        return $communities;
    }
}
