<?php

namespace Modules\BlockManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Modules\Minisite\Minisite;
use Cviebrock\EloquentSluggable\Services\SlugService;


class BlockManagerController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Minisite  $minisite
     * @return \Illuminate\Http\Response
     */
    public function edit(Minisite $minisite)
    {
        if ($minisite->community->captain_id !== Auth::user()->id){
            abort("401", "You are not authorized to edit this page");
        }
        return view('blockmanager::minisite.edit', ['minisite' => $minisite]);
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
        if ($minisite->community->captain_id !== Auth::user()->id){
            abort("401", "You are not authorized to edit this page");
        }
        $minisite->update([
            'visibility' => $data['visibility'],
            'title' => $data['title'],
        ]);
    
        return redirect()->route(
            'communityShow',
            ['id' => $minisite->community->id] )->with( ['id' => $minisite->community->id]
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
