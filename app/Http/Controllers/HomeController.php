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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('home', ['neighborhood' => $user->neighborhood, 'isLoggedIn' => !!$user]);
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

    public function welcome() {
        $user = Auth::user();
        return view('welcome', ['neighborhood' => $user ? $user->neighborhood : null,  'isLoggedIn' => !!$user]);
    }

    public function searching(){
        return view ('searching');
    }

    public function community(){
        return view ('community');
    }

    public function myCommunities(){
        return view ('my-communities');
    }

    public function addBlocks() {
        return view ('add-blocks');
    }

    public function addBlock() {
        return view ('add-block');
    }

    public function editBlock() {
        return view ('edit-block');
    }

    public function manageBlocks() {
        return view ('manage-blocks');
    }

    public function addPinned() {
        return view ('add-pinned');
    }

    public function freeForm() {
        return view ('free-form-content');
    }

    public function createAddress() {
        return view ('neighborhood/create-address');
    }

    public function manageMembers() {
        return view ('manage-members');
    }

    public function manageMember() {
        return view ('manage-member');
    }

    public function inviteMembers() {
        return view ('invite-members');
    }

    public function reorderBlocks() {
        return view ('reorder-blocks');
    }

    public function resetPassword() {
        return view ('reset-password');
    }

    public function changePassword() {
        return view ('change-password');
    }

    public function userProfile() {
        return view ('user-profile');
    }
}
