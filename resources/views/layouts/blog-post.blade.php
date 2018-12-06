<!DOCTYPE html>
<html lang="en">

<head>

    @include('includes.front_header')

</head>

<body>

    <!-- Navigation -->
    @include('includes.front_top_nav')
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-8">
            <!-- Blog Post Content Column -->
              @yield('content')

            </div>
            <!-- Blog Sidebar Widgets Column -->
            @include('includes.front_sidebar')

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        @include('includes.front_footer')

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="{{asset('js/libs.js')}}"></script>

    @yield('scripts')
</body>

</html>
