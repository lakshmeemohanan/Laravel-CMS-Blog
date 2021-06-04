<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Comment;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::all();
        return view('admin.comments', compact('comments'));
    }
    public function store(Request $request){
        $input = request()->validate([
            'comment' => 'required'
        ]);
        $url = $_SERVER['PHP_SELF'];
        $input['post_id'] = $_POST['post_id'];
        $input['user_id'] = auth()->user()->id;
        print_r($input);exit;
        Comment::create($input);
        Session::flash('comment-saved', 'Comment Posted successfully');
        return redirect()->route('post.show',$input['post_id']);
    }
    public function destroy(Comment $comment){
        $comment->delete();
        Session::flash('comment-deleted', 'Comment deleted successfully');
        return redirect()->route('admin.comments');
    }
}
