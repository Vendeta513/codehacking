<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::paginate(8);
      return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::pluck('name', 'id')->all();

      return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
      $input = $request->all();

      $user = Auth::user();

      if($file = $request->file('photo_id')){
        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name);

        $photo = Photo::create(['file'=>$name]);

        $input['photo_id'] = $photo->id;
      }

      $user->posts()->create($input);

      Session::flash('created_post', 'Post was successfully created.');

      return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::findOrFail($id);

      $categories = Category::pluck('name', 'id')->all();

      return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCreateRequest $request, $id)
    {

      // return $request->all();
      $input = $request->all();

      if($file = $request->file('photo_id')){
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        $photo = Photo::create(['file'=>$name]);
        $input['photo_id'] = $photo->id;
      }

      Auth::user()->posts()->whereId($id)->first()->update($input);

      Session::flash('post_updated', 'Post was successfully updated.');
      return redirect('/admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $post = Post::findOrFail($id);

      if($post->photo_id != 0){
        $photo_id = $post->photo_id;

        $photo = Photo::find($photo_id);

        unlink(public_path() . $post->photo->file);

        $photo->delete();

      }


      Auth::user()->posts()->whereId($id)->delete();

      Session::flash('deleted_post', 'Post has been Deleted.');

      return redirect('/admin/posts');

    }


    public function createPost(PostCreateRequest $request){

      $input = $request->all();

      $user = Auth::user();

      if($file = $request->file('photo_id')){
        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name);

        $photo = Photo::create(['file'=>$name]);

        $input['photo_id'] = $photo->id;
      }

      $user->posts()->create($input);
      Session::flash('post_created', 'Post successfully created');
      return redirect()->back();
    }
}
