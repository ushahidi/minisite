<?php

namespace App\Http\Controllers;

use App\Minisite;
use Illuminate\Http\Request;

class MinisiteController extends Controller
{
    /**
     * The only minisite public view
     */
    public function public(){
        return view('minisite.public', ['minisite' => $minisite]);
    }
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Minisite  $minisite
     * @return \Illuminate\Http\Response
     */
    public function show(Minisite $minisite)
    {
        return view('minisite.show', ['minisite' => $minisite]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Minisite  $minisite
     * @return \Illuminate\Http\Response
     */
    public function edit(Minisite $minisite)
    {
        return view('minisite.edit', ['minisite' => $minisite]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Minisite  $minisite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Minisite $minisite)
    {
        $data = $request->input();
        $minisite->update(['visibility' => $data['visibility'], 'title' => $data['title']]);
        
        return redirect()->route(
            'neighborhoodShow',
            ['id' => $minisite->neighborhood->id] )->with( ['id' => $minisite->neighborhood->id]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Minisite  $minisite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Minisite $minisite)
    {
        //
    }
}
