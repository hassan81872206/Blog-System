<x-layout>
  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-12">

        <!-- First Blog Post -->
        @auth
            <h1 class="post-title">Hello {{Auth::user()->username}}</h1>
        @endauth
        @if (session('msg'))
        <div class="alert alert-success" role="alert">{{session('msg')}}</div>
        @endif
        @foreach ($posts as $post)
            @if ($post->likes->isNotEmpty())
                <x-post :user="$post->user" :like="$out" :count="$post->likes_count" :post="$post" :id="$post->id" :title="$post->subject" :description="$post->content" :date="$post->updated_at"></x-post>
            @else
                <x-post :user="$post->user" :like="$in" :count="$post->likes_count" :post="$post" :id="$post->id" :title="$post->subject" :description="$post->content" :date="$post->updated_at"></x-post>
            @endif
        @endforeach

        {{$posts->links()}}

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

</x-layout>
