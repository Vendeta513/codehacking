<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('home')}}">Codehacking</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">

                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
                @if (Auth::guest())
                  <li> <a href="{{route('login')}}">Login</a> </li>
                  <li> <a href="{{route('register')}}">Register</a> </li>
                @else
                  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{$user->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      @if ($user->isAdmin() == true)
                        <li> <a href="{{route('admin.index')}}">Admin</a> </li>
                      @endif
                      <li> <a href="{{route('user_profile', $user->id)}}">Profile</a></li>
                      <li> <a href="{{route('logout')}}">Logout</a> </li>


                    </ul>
                  </li>
                @endif

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
