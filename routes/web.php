<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('index');
});*/

/* Front end routes starts */
Route::get('/', 'PostsController@index')->name('posts.index');
Route::get('/posts/{post}', 'PostsController@show')->name('post.show');

/* Front end routes ends */

/* Admin Panel Routes starts */
Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/admin', 'AdminController@index')->name('admin.index');

    /* Post creation,updation and deletion from admin */
    Route::get('/admin/posts', 'PostsController@user_posts')->name('admin.posts');
    Route::get('/admin/posts/add', 'PostsController@add_post')->name('admin.post.add');
    Route::post('/admin/posts/save', 'PostsController@store')->name('admin.post.store');

    Route::get('/admin/posts/{post}/edit', 'PostsController@edit')->name('admin.post.edit');
    Route::delete('/admin/posts/{post}/destroy', 'PostsController@destroy')->name('admin.post.destroy');
    Route::patch('/admin/posts/{post}/update', 'PostsController@update')->name('admin.post.update');

    /* User Profile */
    Route::patch('/admin/users/{user}/update', 'UserController@update')->name('admin.user.update');
    Route::delete('/admin/users/{user}/destroy', 'UserController@destroy')->name('admin.user.destroy');

});
Route::middleware(['web','auth','role:Admin'])->group(function(){
    Route::get('/admin/users', 'UserController@index')->name('admin.users');
    Route::put('/admin/users/{user}/attach', 'UserController@attach')->name('admin.users.role.attach');
    Route::put('/admin/users/{user}/detach', 'UserController@detach')->name('admin.users.role.detach');
});
/* View User Profile */
Route::middleware('can:view,user')->group(function(){
    Route::get('/admin/users/{user}/profile', 'UserController@show')->name('admin.user.profile');
});
/* Authorization Module - Roles, Permissions */
Route::middleware(['web','auth','role:Admin'])->group(function(){
    Route::get('/admin/roles', 'RoleController@index')->name('admin.user.roles');
    Route::post('/admin/roles/save', 'RoleController@store')->name('admin.role.store');
    Route::delete('/admin/roles/{role}/destroy', 'RoleController@destroy')->name('admin.role.destroy');
    Route::patch('/admin/roles/{role}/update', 'RoleController@update')->name('admin.role.update');
    Route::get('/admin/roles/{role}/edit', 'RoleController@edit')->name('admin.role.edit');
    Route::get('/admin/roles/add', 'RoleController@add')->name('admin.role.add');

    Route::get('/admin/permissions', 'PermissionController@index')->name('admin.user.permissions');
    Route::post('/admin/permissions/save', 'PermissionController@store')->name('admin.permission.store');
    Route::delete('/admin/permissions/{permission}/destroy', 'PermissionController@destroy')->name('admin.permission.destroy');
    Route::patch('/admin/permissions/{permission}/update', 'PermissionController@update')->name('admin.permission.update');
    Route::get('/admin/permissions/{permission}/edit', 'PermissionController@edit')->name('admin.permission.edit');
    Route::get('/admin/permissions/add', 'PermissionController@add')->name('admin.permission.add');
    Route::put('/admin/roles/{role}/attach', 'RoleController@attach')->name('admin.role.permissions.attach');
    Route::put('/admin/roles/{role}/detach', 'RoleController@detach')->name('admin.role.permissions.detach');

    Route::get('/admin/contact', 'ContactController@index')->name('admin.contact');
    Route::delete('/admin/contact/{contact}/destroy', 'ContactController@destroy')->name('admin.contact.destroy');

    Route::get('/admin/comments', 'CommentController@index')->name('admin.comments');
    Route::delete('/admin/comment/{comment}/destroy', 'CommentController@destroy')->name('admin.comment.destroy');
});
/* Admin Panel routes ends */
Route::get('/about', function () {
    return view('about');
});
/* Contact Us */
Route::get('/contact', 'ContactController@show')->name('contact');
Route::post('/contact/save', 'ContactController@store')->name('contact.store');

/* Comments Front end */
Route::middleware('auth')->group(function(){
    Route::post('/comments/{post}', 'CommentController@store')->name('post.comment.store');
});
