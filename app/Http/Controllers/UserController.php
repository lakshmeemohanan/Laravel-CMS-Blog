<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::all();
        return view('admin.users', compact('users')); 
    }
   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user){
        return view('admin.user-profile',[
            'user' => $user,
            'roles' => Role::all()
            ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user){
        $input = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','email', 'max:255'],
            'profile_picture' => ['file:jpg,jpeg,JPG,JPEG'],
        ]);
        if(request('profile_picture')){
            $input['profile_picture'] = request('profile_picture')->store('profile-pictures');
        }
       
        $user->update($input);
        Session::flash('user-updated', 'Details updated successfully');
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user){
        $users = User::findOrFail($user->id);
        unlink(public_path()."/profile-pictures/".$user->profile_picture->file);
        $user->delete();
        Session::flash('user-deleted', 'User deleted successfully');
        return back();
    }
     /**
     * Attach the specified user roles.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function attach(User $user){
        $user->roles()->attach(request('role'));
        return back();
    }
     /**
     * Detach the specified user roles.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detach(User $user){
        $user->roles()->detach(request('role'));
        return back();
    }
}