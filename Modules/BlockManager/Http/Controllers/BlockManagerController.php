<?php

namespace Modules\BlockManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Modules\CommunityManager\Community;
use Modules\BlockManager\Block;

use Modules\BlockManager\BlockTypeFields;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BlockManagerController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function index(Community $community)
    {
        $user = Auth::user();
        if (!$community->owner($user)){
            abort("401", "You are not authorized to edit this page");
        }

        foreach($community->blocks as $block) {
            $content = $block->content;
            $mapped = [];
            foreach ($content as $field_key => $field_value) {
                $fieldDefinition = BlockTypeFields::where(['id' => (int) $field_key])->first();
                //@todo when less asleep: make into a transformer setup of sorts
                $field_value = $this->transform($block, $fieldDefinition, $field_value, $content);
                $mapped[$fieldDefinition->name] = $field_value;
            }
            // @todo not loving this hack... it's almost rude. Refactor when doing tranformers
            if ($block->type === 'RSS Feed' && $mapped['Limit'] && $mapped['Url'] && $mapped['Url']['item']) {
                $mapped['Url']['item'] = array_slice($mapped['Url']['item'], 0, (int) $mapped['Limit']);
            }
            $block->content = $mapped;
            
            if ($block->visibleBy($user, $community)) {
                $returnBlocks[] = $block;
            }
        }
        $collection = collect($returnBlocks);
        $blocks = $community->blocks->sortBy('position');
        $community->blocks = $blocks;
        return view('blockmanager::minisite.admin', ['community' => $community, 'blocks' => $blocks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community)
    {
        $data = $request->input();
        if ($community->captain_id !== Auth::user()->id){
            abort("401", "You are not authorized to edit this page");
        }
        $community->update([
            'visibility' => $data['visibility'],
            'title' => $data['title'],
        ]);
    
        return redirect()->route(
            'communityShow',
            ['id' => $community->id] )->with( ['id' => $community->id]
        );
    }

    public function reorder(Request $request, Community $community) {        
        $blocks = $community->blocks->sortBy('position');
        $sorted = json_encode($blocks->values()->all());
        return view('blockmanager::minisite.reorder', ['community' => $community, 'sorted' => $sorted]);
    }
    
    public function saveOrder(Request $request, Community $community) {
        $reordered = $request->input('reordered');
        if ($reordered) {
            $blocks = json_decode($reordered);

            $sorted = $request->input('reordered');
            $blocks = Block::hydrate($blocks);
            foreach ($blocks as $index => $block) {
                $block->position = $index;
                $block->update();
            }
        }
        return redirect()->route(
            'minisite.admin',
            ['community' => $community] )->with( ['id' => $community->id]
        );
    }
    
    /**
     * Block $block
     * BlockTypeFields $fieldDefinition
     * $field_value: the value assigned by the user in the administration panel for this block field (from the content field)
     * $full_definition: the full content object (assigned by the user in the administration panel)
     */
    private function transform(Block $block, BlockTypeFields $fieldDefinition, $field_value, $full_definition) {
        if ($block->type === 'Featured Youtube Video' && $fieldDefinition->name === 'Url') {
            preg_match('/http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/', $field_value, $youtubeId);
            // @todo: do this in the youtube video creation to validate that it's in fact a youtube url? 
            $field_value = isset($youtubeId[1]) ? $youtubeId[1] : $field_value;
            return $field_value;
        }
        if ($block->type === 'RSS Feed' && $fieldDefinition->name === 'Url') {
            try {
                $feed = \App\Helpers\RSSReader::load($field_value);            
                return $feed ? $feed->toArray() : null;
            } catch (\Exception $e) {
                return null;
            }
            
        }
        return $field_value;
    }
}
