@extends('layouts.blog-home')


@section('content')
  <div class="col-md-8">
    @if ($posts)
      @foreach ($posts as $post)
        <h2>
          <a href="#">{{$post->title}}</a>
        </h2>
        <p class="lead">
          by <a href="index.php">{{$post->user->name}}</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>
        <hr>
        <img class="img-responsive" src="{{$post->photo ? $post->photo->file : "http://placehold.it/900x300" }}" alt="">
        <hr>
        <p>{!! str_limit($post->body, 5) !!}</p>
        <a class="btn btn-primary" href="{{route('blog.post', $post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>

      @endforeach
    @endif

    <!-- Pagination -->
    <div class="">
      {{$posts->render()}}
    </div>

  </div>

  <!-- Blog Sidebar Widgets Column -->
  @include('includes.front_sidebar')
@endsection
