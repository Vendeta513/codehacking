<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Photo;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class AdminMediaController extends Controller
{
  public function index(){
    $photos = Photo::all();
    return view('admin.media.index', compact('photos'));
  }


  public function create(){
    return view('admin.media.create');
  }

  public function store(Request $request){
    $input = $request->all();
    if($file = $request->file('file')){
      $filewithExtension = $file->getClientOriginalName();
      $filename = pathinfo($filewithExtension, PATHINFO_FILENAME);
      $extension = $file->getClientOriginalExtension();
      $name = $filename . '_' . time() . '.' . $extension;
      Storage::disk('s3')->put($name, fopen($file, 'r+'), 'public');
      Photo::create(['file'=>$name]);
    }
    return redirect('/admin/media');
  }

  public function deleteMedia(Request $request){
    if(!empty($request->checkBoxArray)){
      $photos = Photo::findOrFail($request->checkBoxArray);
      foreach($photos as $photo){
        Storage::disk('s3')->delete($photo->file);
        $photo->delete();
      }
      return redirect()->back();
    }else{
      return redirect()->back();
    }
  }
}
