@extends('layouts.blog-home')


@section('content')
  <div class="col-md-8">
    <h1>Blog Posts Wall</h1>
    <hr>
    @if ($posts)
      @foreach ($posts as $post)
        <h2>
          {{$post->title}}
        </h2>
        <p class="lead">
          by {{$post->user->name}}
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
        <hr>
        <img class="img-responsive" src="{{$post->photo ? Storage::disk('s3')->url($post->photo->file) : "http://placehold.it/900x300" }}" alt="">
        <hr>
        <p>{!! str_limit($post->body, 45, '(...)') !!}</p>
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
