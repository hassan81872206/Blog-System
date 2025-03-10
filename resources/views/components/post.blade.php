@props(['post', 'user' , 'count' , 'like' , 'id', 'title', 'description', 'date'])

<h2 class="post-title">
    <p >{{ $title }}</p>
</h2>
@if (Auth::user()->id != $user->id)
    <a href="{{route('other' , $user->id)}}">by {{$user->username}}</a>
@endif
<p><span class="glyphicon glyphicon-time"></span>
    Posted on {{ \Carbon\Carbon::parse($date)->format('F j, Y h:i A') }}
</p>
<p>{{ $description }}</p>
<a class="btn btn-default" href="{{ route('posts.show', $id) }}">Show Posts</a>
<span meta="count-{{$post->id}}">{{$count}}</span>
<p meta="like-{{$post->id}}" class="btn btn-default" onclick="like({{$post->id }} , {{Auth::user()->id}})" >{{$like}}</p>

@can('update', $post)
    <a class="btn btn-default" href="{{ route('posts.edit', $id) }}">Edit</a>
@endcan
@can('delete', $post)
    <form style="display: inline" action="{{route('posts.destroy' , $id)}}" method="POST">
        @method("DELETE")
        @csrf
        <button class="btn btn-default">Delete</button>
    </form>
@endcan

<hr>
