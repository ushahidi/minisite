<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Block;

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
        $returnBlocks = [];
        foreach($minisite->blocks as $block) {
            $content = json_decode($block->content);
            $mapped = [];
            foreach ($content as $field_key => $field_value) {
                $fieldDefinition = BlockTypeFields::where(['id' => (int) $field_key])->first();
                //@todo when less asleep: make into a transformer setup of sorts
                $field_value = $this->transform($block, $fieldDefinition, $field_value);
                $mapped[$fieldDefinition->name] = $field_value;
            }
            $block->content = $mapped;
            if ($this->canSeeBlock($block)) {
                $returnBlocks[] = $block;
            }
        }
        $minisite->blocks = $returnBlocks;
        return view('site.public', ['minisite' => $minisite]);
    }
    
    private function transform(Block $block, BlockTypeFields $fieldDefinition, $field_value) {
        if ($block->type === 'Featured Youtube Video' && $fieldDefinition->name === 'Url') {
            preg_match('/http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/', $field_value, $youtubeId);
            // @todo: do this in the youtube video creation to validate that it's in fact a youtube url? 
            $field_value = isset($youtubeId[1]) ? $youtubeId[1] : $field_value;
        }
        return $field_value;
    }

    private function canSeeMinisite(Minisite $minisite) {
        if ($minisite->visibility === 'public') {
            return true;
        }
        $user = Auth::user();
        $isNeighbor = $user && $user->neighborhood_id && $user->neighborhood_id === $minisite->neighborhood_id;
        if ($minisite->visibility === 'neighbor' && $isNeighbor === true) {
            return true;
        }
        return false;
    }
    
    private function canSeeBlock(Block $block) {
        if ($block->visibility === 'public') {
            return true;
        }
        $user = Auth::user();
        $isNeighbor = $user && $user->neighborhood_id && $user->neighborhood_id === $block->neighborhood_id;
        if ($block->visibility === 'neighbor' && $isNeighbor === true) {
            return true;
        }
        return false;
    }
}
