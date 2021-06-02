<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

use App\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.permissions',[
            'permissions' =>Permission::all()
        ]);
    }
    /**
     * Show the form for adding a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(){
        return view('admin.add-permission');
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
        Permission::create([ 
            'name' => Str::ucfirst(request('name')),
            'slug' => str_slug(request('name'), '-')
        ]);
        Session::flash('permission-saved', 'Permission saved successfully');
        return redirect()->route('admin.user.permissions');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission){
        $permission->delete();
        Session::flash('permission-deleted', 'Permission deleted successfully');
        return redirect()->route('admin.user.permissions');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission){
       return view('admin.edit-permission', [
           'permission' => $permission
       ]); 
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Permission $permission){
        request()->validate([
            'name' => 'required'
        ]);

        $permission->update([
            'name' => Str::ucfirst(request('name')),
            'slug' => str_slug(request('name'), '-')
        ]);
        Session::flash('permission-updated', 'Permission updated successfully');
        return redirect()->route('admin.user.permissions');
    }
}