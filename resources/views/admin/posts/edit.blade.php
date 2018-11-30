@extends('layouts.admin')

@section('content')

  @include('includes.tinyEditor')
  
  <h1>Edit Post</h1>

  <div class="col-sm-3">
    <img src="{{$post->photo ? $post->photo->file : 'https://via.placeholder.com/400'}}" alt="" class="img-responsive">
  </div>


  <div class="col-sm-9">

    @include('includes.form_errors')

    {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}
    <div class="form-group">
      {!! Form::label('title', 'Title') !!}
      {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('category_id', 'Category') !!}
      {!! Form::select('category_id', $categories, null, ['class'=>'form-control'] ) !!}
    </div>

    <div class="form-group">
      {!! Form::label('photo_id', 'Change Photo') !!}
      {!! Form::file('photo_id', ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('body', 'Description') !!}
      {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-6' ]) !!}
    </div>

    {!! Form::close() !!}

    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
    {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-6']) !!}
    {!! Form::close() !!}

  </div>
@endsection
