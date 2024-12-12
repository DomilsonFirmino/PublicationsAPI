<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Publication;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return ['comments'=>Comment::with(['user','comments'])->get()];
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'content'=>'required',
            'publication_id'=>'required|integer',
        ]);

        if(! Publication::find($request->publication_id)){
            return ['message'=>'This publication does not exist'];
        }

        if($request->has('comment_id')){
            $attr['comment_id']=$request->comment_id;
        }else{
            $attr['comment_id']=$request->comment_id;
        }

        $user = $request->user();
        $comment = $user->comments()->create($attr);
        return ['comment'=>$comment,'user'=>$user,'publication'=>Publication::find($request->publication_id)];
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment->load(['user','comments']);
        return ['comment'=>$comment];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {

        if($request->user()->id != $comment->user_id){
            return ["message"=>"You are not autorized"];
        }

        $attr = $request->validate([
            'content'=>'required'
        ]);

        $comment->update($attr);
        return ['comment'=>$comment,'user'=>$request->user()];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Comment $comment)
    {
        if($request->user()->id != $comment->user_id){
           return ["message"=>"You are not autorized"];
        }
        $comment->delete();
        return ["message"=>"Comment deleted sucessfuly"];
    }
}
