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
    public function create(Community $community, Request $request)
    {
        return view('blockmanager::block.create-block', 
            [
                'community' => $community,
                'content' => '{}',
                'blockType' => BlockType::where('id', $request->input('blockType'))->first(),
                'fields' => BlockTypeFields::where('block_type', $request->input('blockType'))->get()
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
        $fields = $request->input('fields') ?? [];
        $freeFormContent = null;
        if ($request->input('blockType') === 'Free form') {
            $freeFormContent = $request->input('content');
            $blockTypeField = BlockTypeFields::where('block_type', $request->input('blockType'))->where('name', 'Content')->first();
            $fields[$blockTypeField->id] = $freeFormContent;
        }
        
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'visibility' => ['required', 'string', 'max:255'],
            'position' => ['required'],
            'enabled' => ['required'],
        ]);
        
        $block = Block::create(
            array_merge(['community_id' => $community->id, 'content' => $fields], $validatedData)
        );
        $block->save();
        
        return redirect()->route(
            'minisite.admin', 
            ['community' => $community]
        );
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
        $newBlock = $block;
        $initialContent = null;
        if ($block->type === 'Free form') {
            $fields = BlockTypeFields::where('block_type', $block->type)->get();
            foreach ($fields as $field) {
                if ($field->name === 'Content') {
                    $initialContent = (new \Scrumpy\ProseMirrorToHtml\Renderer)->render([
                        'type' => 'doc',
                        'content' => json_decode($block->content->{$field->id})->content,
                    ]);
                }
            }
        }

        return view('blockmanager::block.edit-block', 
        [
                'community' => $community,
                'content' => '{}',
                'blockType' => BlockType::where('id', $block->type)->first(),
                'fields' => BlockTypeFields::where('block_type', $block->type)->get(),
                'block' => $block,
                'initialContent' => $initialContent,
                'blockFields' => $block->content,
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
    public function update(Request $request, Community $community, Block $block)
    {

        $fields = $request->input('fields') ?? [];
        $freeFormContent = null;
        if ($block->type === 'Free form') {
            $freeFormContent = $request->input('content');
            $blockTypeField = BlockTypeFields::where('block_type', $block->type)->where('name', 'Content')->first();
            $fields[$blockTypeField->id] = $freeFormContent;
        }
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'visibility' => ['required', 'string', 'max:255'],
            'position' => ['required'],
            'enabled' => ['required'],
        ]);
        
        $validatedData = array_merge(['content' => $fields], $validatedData);
        $block->update($validatedData);
        return redirect()->route(
            'minisite.admin', 
            ['community' => $community]
        );
        
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
        
        return redirect()->route(
            'minisite.admin', 
            ['community' => $community]
        );
    }
}
