<?php

namespace Modules\Minisite\Http\Controllers;
use Modules\Minisite\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Modules\Minisite\Models\Block;
use Modules\Minisite\Models\BlockType;
use Modules\Minisite\Models\BlockTypeFields;
use App\Http\Controllers\Controller ;

class BlockController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Community $community, Request $request)
    {
        $this->authorize('update', $community);

        return view('minisite::block.create-block', 
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
        $this->authorize('update', $community);

        return view('minisite::block.create', 
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
        $this->authorize('update', $community);

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
        $this->authorize('update', $community);
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

        return view('minisite::block.edit-block', 
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
        $this->authorize('update', $community);

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
        $this->authorize('delete', $community);

        $block->delete();
        
        return redirect()->route(
            'minisite.admin', 
            ['community' => $community]
        );
    }
}
