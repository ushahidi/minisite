<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\BlockTypeFields;
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
        foreach($minisite->blocks as &$block) {
            $content = json_decode($block->content);
            $mapped = [];
            if ($block->type === 'Featured Youtube Video') {
                
            }
            foreach ($content as $field_key => $field_value) {
                $fieldDefinition = BlockTypeFields::where(['id' => (int) $field_key])->first();
                //@todo when less asleep: make into a transformer setup of sorts
                if ($block->type === 'Featured Youtube Video' && $fieldDefinition->name === 'Url') {
                    preg_match('/http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/', $field_value, $youtubeId);
                    // @todo: do this in the youtube video creation to validate that it's in fact a youtube url? 
                    $field_value = isset($youtubeId[1]) ? $youtubeId[1] : $field_value;
                }
                $mapped[$fieldDefinition->name] = $field_value;
            }
            $block->content = $mapped;
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
