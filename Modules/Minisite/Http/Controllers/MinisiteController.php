<?php

namespace Modules\Minisite\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;
use Illuminate\Support\Facades\Auth;
use App\User;
use Modules\Minisite\Models\Community;
use Modules\Minisite\Models\Block;
use Modules\Minisite\Models\Invite;
use Modules\Minisite\Models\UserCommunity;

use Carbon\Carbon;
use Modules\Minisite\Models\BlockTypeFields;
use Cviebrock\EloquentSluggable\Services\SlugService;

class MinisiteController extends Controller
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

        $role = $community->getRole($user);

        if ($role === '' || $role ==='guest' || (!$user && $community->visibility !== Community::VISIBILITY_PUBLIC)){
            abort(401);
        }
        $returnBlocks = [];
        foreach($community->blocks as $block) {
            $content = $block->content;
            $mapped = [];
            try {
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
            }catch (\Exception $e){
                // @decide we could delete the block's content if we end up in an exception because of $content?
                // @decide maybe we also show them a ->flash() error explaining what happened
                \Log::warn("There was an issue going through the content for this block");
                \Log::warn(var_export($block,true));
                // if (!is_array($block->content)) {
                //     $block->content = [];
                //     $block->save();
                // }
            }
            
        }
        $collection = collect($returnBlocks);
        $blocks = $collection->sortBy('position');
        $community->blocks = $blocks;
        return view('minisite::minisite.admin', ['community' => $community, 'blocks' => $blocks, 'role' => $role]);
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
        $this->authorize('update', $community);

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
        $this->authorize('update', $community);
  
        $blocks = $community->blocks->sortBy('position');
        $sorted = json_encode($blocks->values()->all());
        return view('minisite::minisite.reorder', ['community' => $community, 'sorted' => $sorted]);
    }
    
    public function saveOrder(Request $request, Community $community) {
        $this->authorize('update', $community);

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
