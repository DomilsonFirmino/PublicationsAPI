<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ['comments'=>Comment::with('user')->get()];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'content'=>'required',
            'publication_id'=>'required|integer',
        ]);

        if($request->has('comment_id')){
            $attr['comment_id']=$request->comment_id;
        }else{
            $attr['comment_id']=$request->comment_id;
        }

        $user = $request->user();
        $comment = $user->comments()->create($attr);
        return ['comment'=>$comment,'user'=>$user];
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return ['comment'=>$comment];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
