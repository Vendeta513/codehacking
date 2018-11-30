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


  public function create(){
    return view('admin.media.create');
  }

  public function store(Request $request){

    $file = $request->file('file');

    $name = time() . $file->getClientOriginalName();

    $file->move('images', $name);

    Photo::create(['file'=>$name]);


    return redirect('/admin/media');
  }


  public function destroy($id){


    $photo = Photo::findOrFail($id);

    unlink(public_path() . $photo->file);

    $photo->delete();

  }

  public function deleteMedia(Request $request){

    // if(isset($request->single_remove)){
    //   // return $request->all();
    //
    //   $this->destroy($request->image_id);
    //
    //   return redirect()->back();
    // }


    if(isset($request->multiple_remove) && !empty($request->checkBoxArray)){
      $images = Photo::findOrFail($request->checkBoxArray);

      foreach ($images as $image) {
        $photo = Photo::findOrFail($image->id);

        unlink(public_path() . $photo->file);

        $photo->delete();
      }

      return redirect()->back();
    }else{
      return redirect()->back();
    }
  }



}
