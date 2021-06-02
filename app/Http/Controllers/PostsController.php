<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use Auth;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $input = request()->validate([
            'title' => 'required|min:8|max:191',
            'long_description' => 'required',
            'short_description' => 'required',
            'featured_image' => 'file'
        ]);
        if(request('featured_image')){
            $input['featured_image'] = request('featured_image')->store('post-uploads');
        }else{
            $input['featured_image'] = '';
        }
        auth()->user()->posts()->create($input);
        Session::flash('post-saved', 'Post saved successfully');
        return redirect()->route('admin.posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post){
        return view('posts.show', [
            'post' => $post,
            'comments' => $post->comments()->with('user')->orderBy('created_at','desc')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post){
        return view('admin.edit-post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        $input = request()->validate([
            'title' => 'required|min:8|max:191',
            'long_description' => 'required',
            'short_description' => 'required',
            'featured_image' => 'file'
        ]);
        if(request('featured_image')){
            $input['featured_image'] = request('featured_image')->store('uploads');
            $post['featured_image'] = $input['featured_image'];
        }
        $post->title = $input['title'];
        $post->short_description = $input['short_description'];
        $post->long_description = $input['long_description'];

        $this->authorize('update', $post);
        $post->save();
        Session::flash('post-updated', 'Post updated successfully');
        return redirect()->route('admin.posts');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post){
        $posts = Post::findOrFail($post->id);
        unlink(public_path()."/post-uploads/".$post->featured_image->file);
        $post->delete();
        Session::flash('post-deleted', 'Post deleted successfully');
        return back();
    }
    /**
     * Display the user's posts based on session id
     *
     * @return \Illuminate\Http\Response
     */
    public function user_posts(){
        $posts = auth()->user()->posts()->paginate(5);
        return view('admin.posts', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_post(){
        return view('admin.add-post');
    }
}