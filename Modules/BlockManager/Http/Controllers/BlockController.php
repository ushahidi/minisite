<?php

namespace Modules\BlockManager\Http\Controllers;
use Modules\CommunityManager\Community;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Modules\BlockManager\Block;
use Modules\BlockManager\BlockType;
use Modules\BlockManager\BlockTypeFields;
use Illuminate\Routing\Controller;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Community $community)
    {
        return view('blockmanager::block.create-block', 
            [
                'community' => $community,
                'content' => '{}',
                'types' => BlockType::get(),
                'fields' => BlockTypeFields::get()
            ]
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTypes(Community $community)
    {
        return view('blockmanager::block.create', 
            [
                'community' => $community,
                'content' => '{}',
                'blockTypes' => BlockType::get(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Community $community)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'visibility' => ['required', 'string', 'max:255'],
            'position' => ['required', 'integer'],
            "enabled" => ['required']
        ]);
        $contentFields = json_encode($request->input('blockFields'));
        
        $block = Block::create(array_merge(['community_id' => $community->id, 'content' => $contentFields], $validatedData));
        $block->save();
        return view('blockmanager::minisite.edit', ['community' => $community]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community, Block $block)
    {
        return view('blockmanager::block.edit', 
            [
                'community' => $community,
                'block' => $block,
                'content' => '{}',
                'types' => BlockType::get(),
                'fields' => BlockTypeFields::get(),
                'blockFields' => json_encode($block)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $communitySlug, $blockId)
    {

        $block = Block::findOrFail($blockId);
        $community = Community::where(['slug' => $communitySlug])->first();
        $contentFields = json_encode($request->input('blockFields'));
        $inputs = array_merge($request->input(), ['content' => $contentFields]);
        $validator = \Validator::make($inputs, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'visibility' => ['required', 'string', 'max:255'],
            'position' => ['required', 'integer'],
            'content' => ['required', 'json'],
            'enabled' => ['required']
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 422);
        }

        if ($block->update($inputs)) {
            return response()->json([
                'success' => [
                    'communityId' => $community->id,
                    'block' => $block
                ]
            ]);
        } else {
            return response()->json(['error' => 'An unexpected error occured. Please try again later.'], 500);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community, Block $block)
    {
        $block->delete();
        return view('community.show', ['community' => $community]);
    }
}
