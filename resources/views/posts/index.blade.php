<x-layout>
    <!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Page Title -->
        <div class="col-md-12">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            @if (session('success'))
                <div class="alert alert-success" role="alert">{{session('success')}}</div>
            @endif
            @if (Auth::user()->id === $userID)
                <h2>Posts by you ({{$count}})</h2>
                <h3>Create a post</h3>
                <a class="btn btn-primary" href="{{route('posts.create')}}">Create post</a>
            @endif
        </div>
        <!-- Blog Entries Column -->
        <div class="col-md-12">

            @forelse ($posts as $post)
                @if ($post->likes->isNotEmpty())
                    <x-post :user="$post->user" :like="$out" :count="$post->likes_count" :post="$post" :id="$post->id" :title="$post->subject" :description="$post->content" :date="$post->updated_at"></x-post>
                @else
                    <x-post :user="$post->user" :like="$in" :count="$post->likes_count" :post="$post" :id="$post->id" :title="$post->subject" :description="$post->content" :date="$post->updated_at"></x-post>
                @endif
            @empty

            @endforelse
            {{$posts->links()}}
        </div>
    </div>
</div>

</x-layout>
