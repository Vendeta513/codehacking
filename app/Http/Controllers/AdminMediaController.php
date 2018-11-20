<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Photo;
use App\Http\Requests;

class AdminMediaController extends Controller
{
  public function index(){
    $photos = Photo::all();

    return view('admin.media.index', compact('photos'));
  }
}
