<?php

namespace App\Http\Controllers;
use App\Minisite;

use App\Block;
use Illuminate\Http\Request;
use App\BlockType;
use App\BlockTypeFields;

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
     * #parameters: array:7 [
      "blockFields" => array:1 [
        3 => "aaaa"
      ]
    ]
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
                'block'    => $block,
                'types' => BlockType::get()
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
    public function update(Request $request, Block $block)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'visibility' => ['required', 'string', 'max:255'],
            'position' => ['required', 'integer'],
            'content' => ['required', 'json'],
        ]);
        $enabled = $request->input('enabled');
        $validatedData['enabled'] = is_array($enabled) && array_pop($enabled) === 'on' ? true : false;
        
        $block->update($validatedData);
        return view('neighborhood.show', ['neighborhood' => $minisite->neighborhood]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block)
    {
        //
    }
}
