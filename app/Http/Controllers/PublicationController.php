<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_size = $request->size ?? 10;
        return ['publications'=>Publication::with('user')->paginate($page_size)];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'title'=>'required|unique:publications,title',
            'content'=>'required',
        ]);
        $attr['img']=null;
        $user = $request->user();
        $pub = $user->publications()->create($attr);
        return ['publication'=>$pub];
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        $publication->load(['user']);
        return ['publication'=>$publication];
    }

    public function showComments(Publication $publication, Request $request)
    {
        $page_size = $request->size ?? 10;
        $publication->load(['user']);
        $comments = $publication->comments()->paginate($page_size);
        return ['publication'=>$publication,'comments'=>$comments];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {

        $user = $request->user();

        if($user->id != $publication->user_id){
            return ['messague' => 'You are not allowed'];
        }

        $attr = $request->validate([
            'title'=>'required|unique:publications,title',
            'content'=>'required',
        ]);

        $publication->update($attr);
        return ['publication'=>$publication,'user'=>$user];
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Publication $publication)
    {
        if($request->user()->id != $publication->user_id){
            return ['messague' => 'You are not allowed'];
        }

        $publication->delete();
        return ['messague' => 'Publication deleted sucessfuly'];
    }
}
