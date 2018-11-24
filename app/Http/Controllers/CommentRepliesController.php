<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Comment_Reply;
use App\Comment;

use App\Http\Requests;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $comment = Comment::findOrFail($id);

      $replies = $comment->replies;

      return view('admin.comments.replies.show', compact('replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      Comment_Reply::findOrFail($id)->update($request->all());

      return redirect()->back();

      // return view('admin.comments.replies.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Comment_Reply::findOrFail($id)->delete();

      return redirect()->back();
    }

    public function createReply(Request $request){
      $user = Auth::user();

      $data = [
        'comment_id'=>$request->comment_id,
        'author'=>$user->name,
        'photo'=>$user->photo->file,
        'email'=>$user->email,
        'body'=>$request->body
      ];

      Comment_Reply::create($data);

      Session::flash('reply_posted', 'Your reply has been submitted');


      return redirect()->back();
    }
}
