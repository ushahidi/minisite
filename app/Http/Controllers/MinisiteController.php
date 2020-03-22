<?php

namespace App\Http\Controllers;

use App\Minisite;
use Illuminate\Http\Request;

class MinisiteController extends Controller
{
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
        $minisite->update([
            'visibility' => $data['visibility'],
            'title' => $data['title'],
            'slug' => SlugService::createSlug(Post::class, 'slug', $data['title'])]
        );
    
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
