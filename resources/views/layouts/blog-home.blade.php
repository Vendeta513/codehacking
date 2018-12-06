<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.front_header')
</head>

<body>

    <!-- Top Header Navigation -->
    @include('includes.front_top_nav')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            @yield('content')
        </div>
        <!-- /.row -->
        <hr>
        <!-- Footer -->
        @include('includes.front_footer')
    </div>

    <!-- jQuery -->
    <script src="{{asset('js/libs.js')}}"></script>
    @yield('scripts')
</body>

</html>
