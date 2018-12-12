@extends('layouts.blog-post')

@section('content')

      <!-- Blog Post -->

      <!-- Title -->
      <h1>{{$post->title}}</h1>

      <!-- Author -->
      <p class="lead">
          by {{$post->user->name}}
      </p>

      <hr>

      <!-- Date/Time -->
      <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

      <hr>

      <!-- Preview Image -->
      <img class="img-responsive" src="{{$url}}" alt="">

      <hr>

      <!-- Post Content -->
      <p class="lead"> {!! $post->body !!}</p>
      <hr>

      <!-- Blog Comments -->

      @if (Auth::check())


        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>

            @if (Session::has('comment_posted'))
              <p>{{session('comment_posted')}}</p>
            @endif

            {!! Form::open(['method'=>'POST', 'action'=>['PostCommentsController@postComment']]) !!}
              <input type="hidden" name="post_id" value="{{$post->id}}">
              <div class="form-group">
                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
              </div>
            {!! Form::close() !!}
        </div>

      @endif
      <hr>

      <!-- Posted Comments -->
      @if (count($comments) > 0)

        @foreach ($comments as $comment)
          <!-- Comment -->
          <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object" height="64" src="{{$comment->photo ? Storage::disk('s3')->url($comment->photo) : 'http://placehold.it/64x64' }} " alt="">
            </a>
            <div class="media-body">
              <h4 class="media-heading">{{$comment->author}}
                <small>Posted {{$comment->created_at->diffForHumans()}}</small>
              </h4>

                {{$comment->body}}


              <div class="comment_reply_container">

                <button type="button" name="button" class="toggle-reply btn btn-primary">Reply</button>

                <div class="reply_form">
                  @if (Session::has('reply_posted'))
                    <p>{{session('reply_posted')}}</p>
                  @endif
                  {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}

                  <input type="hidden" name="comment_id" value="{{$comment->id}}">

                  <div class="form-group">
                    {!! Form::text('body', null, ['class'=>'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::submit('Submit Reply', ['class'=>'btn btn-primary']) !!}
                  </div>
                  {!! Form::close() !!}
                </div>
              </div>

              @if (count($comment->replies) > 0)

                  @foreach ($comment->replies as $reply)
                    @if ($reply->is_active  == 1)

                    <!-- Nested Comment -->
                    <div class="media">
                      <a class="pull-left" href="#">
                        <img height="64" class="media-object" src="{{$reply->photo ? Storage::disk('s3')->url($reply->photo) : 'http://placehold.it/64x64'}}" alt="">
                      </a>
                      <div class="media-body">
                        <h4 class="media-heading">{{$reply->author}}
                          <small>on {{$reply->created_at->diffForHumans()}}</small>
                        </h4>
                      </div>
                      {{$reply->body}}
                    </div>
                    <!-- End Nested Comment -->
                    @endif
                  @endforeach

              @endif

            </div>
          </div>

          <!-- Comment -->
        @endforeach

      @endif

      {{-- <div id="disqus_thread"></div>
      <script>

      /**
      *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
      *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
      /*
      var disqus_config = function () {
      this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
      this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
      };
      */
      (function() { // DON'T EDIT BELOW THIS LINE
      var d = document, s = d.createElement('script');
      s.src = 'https://codehacking-lthf1qparp.disqus.com/embed.js';
      s.setAttribute('data-timestamp', +new Date());
      (d.head || d.body).appendChild(s);
      })();
      </script>
      <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>


      <script id="dsq-count-scr" src="//codehacking-lthf1qparp.disqus.com/count.js" async></script> --}}
@endsection


@section('scripts')
  <script>
    $(".comment_reply_container .toggle-reply").click(function(){
      $(this).next().slideToggle('slow');
    });
  </script>

@endsection
