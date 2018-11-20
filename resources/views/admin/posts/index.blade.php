@extends('layouts.admin')


@section('content')
    <h1>Posts</h1>

    @if (Session::has('created_post'))
      <p class="alert alert-success">{{session('created_post')}}</p>
    @endif

    @if (Session::has('deleted_post'))
      <p class="alert alert-danger">{{session('deleted_post')}}</p>
    @endif

    <table class="table table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Owner</th>
        <th>Category</th>
        <th>Title</th>
        <th>Body</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>

      @if ($posts)
        @foreach ($posts as $post)
          <tr>
            <td>{{$post->id}}</td>
            <td><img height="50" src="{{$post->photo ? $post->photo->file : 'https://via.placeholder.com/400'}}" alt=""></td>
            <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
            <td>{{$post->category ? $post->category->name : 'no category'}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
          </tr>

          @endforeach
        @endif
    </tbody>
  </table>

@endsection
