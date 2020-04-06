<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
    // public function addBlocks() {
    //     return view ('add-blocks');
    // }

    // public function addBlock() {
    //     return view ('add-block');
    // }

    // public function editBlock() {
    //     return view ('edit-block');
    // }
}
