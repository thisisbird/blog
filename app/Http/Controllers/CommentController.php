<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
class CommentController extends Controller
{
    public function index(Post $post){
        $a = $post->comments()->with('user')->orderBy('id','asc')->first();
        return response()->json($a);
    }
    public function store(Request $request,Post $post){
        $comment = $post->comments()->create([
            'body'=>$request->body,
            'user_id'=>Auth::id()
        ]);
        $comment = Comment::where('id',$comment->id)->with('user')->first();
        return $comment->toJson();
    }
}
