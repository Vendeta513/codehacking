<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
  // protected $directory = '/images/';

  protected $fillable = ['file'];

  //
  // public function getFileAttribute($path){
  //   return $this->directory . $path;
  // }

  public function post(){
    return $this->hasOne('App\Post');
  }
}
