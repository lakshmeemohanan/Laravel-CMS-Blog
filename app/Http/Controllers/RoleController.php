<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

use App\Role;
use App\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.roles',[
            'roles' =>Role::all()
        ]);
    }
    /**
     * Show the form for adding a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(){
        return view('admin.add-role');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(){
        request()->validate([
            'name' => 'required'
        ]);
        Role::create([ 
            'name' => Str::ucfirst(request('name')),
            'slug' => str_slug(request('name'), '-')
        ]);
        Session::flash('role-saved', 'Role saved successfully');
        return redirect()->route('admin.user.roles');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role){
        $role->delete();
        Session::flash('role-deleted', 'Role deleted successfully');
        return redirect()->route('admin.user.roles');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role){
       return view('admin.edit-role', [
           'role' => $role,
           'permissions' => Permission::all()
       ]); 
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role){
        request()->validate([
            'name' => 'required'
        ]);

        $role->update([
            'name' => Str::ucfirst(request('name')),
            'slug' => str_slug(request('name'), '-')
        ]);
        Session::flash('role-updated', 'Role updated successfully');
        return redirect()->route('admin.user.roles');
    }
    /**
     * Attach the specified role permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function attach(Role $role){
        $role->permissions()->attach(request('permission'));
        return back();
    }
    /**
     * Detach the specified role permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detach(Role $role){
        $role->permissions()->detach(request('permission'));
        return back();
    }
}