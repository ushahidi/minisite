<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Modules\Minisite\Minisite;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
class MinisiteController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Minisite  $minisite
     * @return \Illuminate\Http\Response
     */
    public function edit(Minisite $minisite)
    {
        if ($minisite->neighborhood->captain_id !== Auth::user()->id){
            abort("401", "You are not authorized to edit this page");
        }
        return view('minisite.edit', ['minisite' => $minisite]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Minisite  $minisite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Minisite $minisite)
    {
        $data = $request->input();
        if ($minisite->neighborhood->captain_id !== Auth::user()->id){
            abort("401", "You are not authorized to edit this page");
        }
        $minisite->update([
            'visibility' => $data['visibility'],
            'title' => $data['title'],
        ]);
    
        return redirect()->route(
            'neighborhoodShow',
            ['id' => $minisite->neighborhood->id] )->with( ['id' => $minisite->neighborhood->id]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Minisite  $minisite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Minisite $minisite)
    {
        //
    }
}
