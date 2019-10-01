<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;
class CommentController extends Controller
{
    public function index(Post $post){
        $a = $post->comments()->with('user')->orderBy('id','asc')->get();
        return response()->json($a);
    }
    public function store(Request $request,Post $post){
        $id = Auth::id() ? 1 : 2;
        $comment = $post->comments()->create([
            'body'=>$request->body,
            'user_id' => 1
        ]);
        $comment = Comment::where('id',$comment->id)->with('user')->first();
        return $comment->toJson();
    }
}
