<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;

use App\Minisite;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SiteController extends Controller
{
    /**
     * The only minisite public view
     */
    public function public(Minisite $minisite){
        if (!$this->canSeeMinisite($minisite)) {
            abort(403, 'The site is not available.');
        }
        return view('site.public', ['minisite' => $minisite]);
    }

    private function canSeeMinisite(Minisite $minisite) {
        if ($minisite->visibility === 'public') {
            return true;
        }
        $user = Auth::user();
        $isNeighbor = $user && $user->neighborhood_id === $minisite->neighborhood_id;
        if ($minisite->visibility === 'neighbor' && $isNeighbor === true) {
            return true;
        }
        return false;
    }
}
