<?php

namespace Modules\BlockManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Modules\CommunityManager\Community;
use Modules\BlockManager\Block;

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
        if (!$community->owner(Auth::user())){
            abort("401", "You are not authorized to edit this page");
        }
        return view('blockmanager::minisite.admin', ['community' => $community]);
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
}
