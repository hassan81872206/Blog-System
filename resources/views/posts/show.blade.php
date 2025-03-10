<x-layout>
    <!-- Page Content -->
<div class="container">

    <div class="row">

      <!-- Blog Post Content Column -->
      <div class="col-lg-12">

        <!-- Blog Post -->

        <!-- Title -->
        <h1 class="post-title">{{$post->subject}}</h1>

        <!-- Author -->
        <a href="author.html" class="lead">
          {{$post->user->username}}
        </a>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span>
          Posted on {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y h:i A') }}
        </p>
        <hr>

        <!-- Post Content -->
        <p>{{$post->content}}</p>

        <hr>

        <!-- Blog Comments -->

        <!-- Comments Form -->

        <div class="well">
          <h4>Leave a Comment:</h4>
          <p style="color: red" id="error"></p>
          <form role="form">
            <div class="form-group">
              <textarea id="comment" class="form-control" rows="3"></textarea>
            </div>
            <button onclick="addComment({{$post->id}} , {{Auth::user()->id}} , '{{Auth::user()->username}}')" type="button" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div style="display: none" id="success" class="alert alert-success" role="alert"></div>

        <hr>

        <!-- Posted Comments -->

        <!-- Comment -->
        @foreach ($comments as $comment)
          <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
              <h4 class="media-heading">{{$comment->user->username}}
                <small>{{ \Carbon\Carbon::parse($comment->updated_at)->format('F j, Y h:i A') }}</small>
              </h4>
              {{$comment->comment}}
            </div><br>
            @forelse ($subComments as $subComment )
                @if ($subComment->parentID === $comment->id)
                    <div style="margin-left: 40px;">
                        <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                        <h4 class="media-heading">{{$subComment->user->username}}
                            <small>{{ \Carbon\Carbon::parse($subComment->updated_at)->format('F j, Y h:i A') }}</small>
                        </h4>
                        {{$subComment->comment}}
                        </div><br>
                    </div>
                @endif
            @empty

            @endforelse
            <div style="margin-left: 40px;" meta="reply-{{$comment->id}}"></div><br>

            <div class="form-group">
              <label for="subComment">Reply</label>
              <span style="color:red" meta="error-{{$comment->id}}"></span>
              <input type="text" id="subComment" class="form-control"><br>
              <button type="button" onclick="addSubComment({{$post->id}} , {{Auth::user()->id}} , '{{Auth::user()->username}}' , {{$comment->id}})" class="btn btn-primary">Send Reply</button>
            </div>
          </div>
          <hr>
        @endforeach


        <!-- Comment -->
         <div class="media">
          <div id="containerComment">
            <a class="pull-left" href="#">
              <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
              <h4 id="name" class="media-heading">
                <small id="date"></small>
              </h4>
              <span id="comment"></span>
          </div>
          </div>
        </div>

      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
</x-layout>
