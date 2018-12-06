@extends('layouts.blog-post')


@section('content')
  <div class="container">
    <div class="row profile">
  		<div class="col-md-3">
  			<div class="profile-sidebar">
  				<!-- SIDEBAR USERPIC -->
  				<div class="profile-userpic">
  					<img src="{{$user->photo ? $user->photo->file : 'http://placehold.it/64x64'}}" class="img-responsive img-rounded" alt="">
  				</div>
  				<!-- END SIDEBAR USERPIC -->
  				<!-- SIDEBAR USER TITLE -->
  				<div class="profile-usertitle text-left">
  					<div class="profile-usertitle-name">
  						<h2>{{$user->name}}</h2>
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
  		<div class="col-md-9">
              <div class="profile-content">
  			        <h1>Create new Blog</h1>
              </div>
  		</div>
  	</div>
  </div>

  <br>
  <br>
@endsection
