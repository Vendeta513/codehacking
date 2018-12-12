@extends('layouts.blog-post')


@section('content')
  <div class="container">
    <div class="row profile">
  		<div class="col-md-2">
  			<div class="profile-sidebar">
  				<!-- SIDEBAR USERPIC -->
  				<div class="profile-userpic">
  					{{-- <img src="{{$user->photo ? $user->photo->file : 'http://placehold.it/165x165'}}" class="img-responsive img-rounded" alt=""> --}}
            <img height="150" src="{{$url}}" class="img-response img-rounded" alt="">
  				</div>
  				<!-- END SIDEBAR USERPIC -->
  				<!-- SIDEBAR USER TITLE -->
  				<div class="profile-usertitle text-left">
  					<div class="profile-usertitle-name">
  						<h3>{{$user->name}}</h3>
  					</div>
  					<div class="profile-usertitle-job">
  						<strong>{{$user->role->name}}</strong>
  					</div>
  				</div>
  				<!-- END SIDEBAR USER TITLE -->
  				<!-- SIDEBAR BUTTONS -->
  				<div class="profile-userbuttons">
  					<button type="button" class="btn btn-success btn-sm">Follow</button>
  					<button type="button" class="btn btn-danger btn-sm">Message</button>
  				</div>
  				<!-- END SIDEBAR BUTTONS -->
  				<!-- SIDEBAR MENU -->
  				<div class="profile-usermenu">
  					<ul class="nav">
  						<li class="active">
  							<a href="#">
  							<i class="glyphicon glyphicon-home"></i>
  							Overview </a>
  						</li>
  						<li>
  							<a href="#">
  							<i class="glyphicon glyphicon-user"></i>
  							Account Settings </a>
  						</li>
  						<li>
  							<a href="#" target="_blank">
  							<i class="glyphicon glyphicon-ok"></i>
  							Tasks </a>
  						</li>
  						<li>
  							<a href="#">
  							<i class="glyphicon glyphicon-flag"></i>
  							Help </a>
  						</li>
  					</ul>
  				</div>
  				<!-- END MENU -->
  			</div>
  		</div>
  		<div class="col-md-6">
              <div class="profile-content">
                @include('includes.tinyEditor')

                <div class="create_post_container">
                  <button type="button" name="button" class="toggle_post btn btn-primary"> Create New Blog</button>

                  <div class="post_form">

                    @if (Session::has('post_created'))
                      <p class="alert alert-success">{{session('post_created')}}</p>
                    @endif


                    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@createPost', 'files'=>true]) !!}
                    <div class="form-group">
                      {!! Form::label('title', 'Title') !!}
                      {!! Form::text('title', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('category_id', 'Category') !!}
                      {!! Form::select('category_id', [''=>'Choose category'] + $blog_categories, null, ['class'=>'form-control'] ) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('photo_id', 'Photo') !!}
                      {!! Form::file('photo_id', ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('body', 'Description') !!}
                      {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>4]) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="">
                  @if ($posts)
                    @foreach ($posts as $post)
                      <hr>
                      <h3> <a href="#">{{$post->title}}</a> </h3>

                      <p ><span class="glyphicon glyphicon-time"></span>Posted on {{$post->created_at->format('M d Y')}}</p>
                      <hr>
                      <img class="img-responsive" src="{{$post->photo ? Storage::disk('s3')->url($post->photo->file) : 'http://placehold.it/900x300'}}" alt="">
                      <hr>
                      <p>{!! $post->body !!}</p>
                      <a class="btn btn-primary" href="{{route('blog.post', $post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                      <hr>
                    @endforeach
                  @endif
                </div>
              </div>
      </div>

    </div>
  </div>

  <br>
  <br>
@endsection


@section('scripts')
  <script>
  $(".toggle_post").click(function(){
    $(this).next().slideToggle('slow');
  });
  </script>
@endsection
