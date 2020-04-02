<?php

namespace App\Http\Controllers;
use Modules\Minisite\Minisite;

use App\Block;
use Illuminate\Http\Request;
use App\BlockType;
use App\BlockTypeFields;
use Illuminate\Validation\Validator;
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
    public function create(Minisite $minisite)
    {
        return view('block.create', 
            [
                'minisite' => $minisite,
                'content' => '{}',
                'types' => BlockType::get(),
                'fields' => BlockTypeFields::get()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Minisite $minisite)
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
        
        $block = Block::create(array_merge(['minisite_id' => $minisite->id, 'content' => $contentFields], $validatedData));
        $block->save();
        return view('neighborhood.show', ['neighborhood' => $minisite->neighborhood]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Minisite $minisite, Block $block)
    {
        return view('block.edit', 
            [
                'minisite' => $minisite,
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
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $minisiteSlug, $blockId)
    {

        $block = Block::findOrFail($blockId);
        $minisite = Minisite::where(['slug' => $minisiteSlug])->first();
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
                    'neighborhoodId' => $minisite->neighborhood->id,
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
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Minisite $minisite, Block $block)
    {
        $block->delete();
        return view('neighborhood.show', ['neighborhood' => $minisite->neighborhood]);
    }
}
