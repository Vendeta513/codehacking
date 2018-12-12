<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\Category;
use App\Post;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
        $posts = Post::paginate(2);
        return view('front.home', compact('posts', 'categories', 'user'));
    }

    public function post($slug){
      $user = Auth::user();
      $categories = Category::all();
      $post = Post::findBySlugOrFail($slug);
      $url = $post->photo ? Storage::disk('s3')->url($post->photo->file) : 'http://placehold.it/900x300';
      $comments = $post->comments()->where('is_active', 1)->get();
      return view('post', compact('categories', 'post', 'comments', 'user', 'url'));
    }
}
