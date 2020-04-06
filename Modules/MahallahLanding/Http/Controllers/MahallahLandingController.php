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
use Modules\CommunityManager\Community;
use Modules\CommunityManager\CommunityLocation;
use Illuminate\Support\Facades\DB;
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
                    'community' => $user ? $user->community : null,  
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
        $input = $request->input('query');
        $communities = DB::table('communities')
            ->join('community_locations', 'communities.location_id', '=', 'community_locations.id', 'left')
            ->where(function ($query) use ($input) {
                $query->where('name', 'LIKE', "%$input%")
                    ->orWhere('description', 'LIKE', "%$input%")
                    ->orWhere('community_locations.postal_code', 'LIKE', "%$input%")
                    ->orWhere('community_locations.display_name', 'LIKE', "%$input%")
                    ->orWhere('community_locations.locality', 'LIKE', "%$input%")
                    ->orWhere('community_locations.city', 'LIKE', "%$input%")
                    ->orWhere('community_locations.state', 'LIKE', "%$input%")
                    ->orWhere('community_locations.country', 'LIKE', "%$input%");
                }
            )->get();
        return view('mahallahlanding::search', compact('communities'));
    }
    
    private function activeCommunities() {
        $communities = \Modules\CommunityManager\Community::orderBy('created_at', 'desc')
               ->take(5)
               ->get();
        return $communities;
    }
}
