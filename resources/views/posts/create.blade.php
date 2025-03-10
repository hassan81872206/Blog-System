<x-layout>
     <!-- Page Content -->
     <div class="container">

        <div class="row">
  
          <!-- Newpost content  -->
          <div class="col-lg-12 newpost">
  
            <!-- Title -->
            <h1>New post</h1>
  
            <!-- Newpost form -->
            <form action="{{route('posts.store')}}" method="POST" class="newpost-form">
                @csrf
                <input type="hidden" name="userID" value="{{Auth::user()->id}}" id="">
              <div class="form-group">
                <label for="subject">Subject</label>
                @error('subject')
                    <p style="color:red">{{$message}}</p>
                @enderror
                <input value="{{old('subject')}}" type="text" id="subject" name="subject" class="form-control">
              </div>
  
              <div class="form-group">
                <label for="content">Content</label>
                @error('content')
                    <p style="color:red">{{$message}}</p>
                @enderror
                <textarea rows="5" id="content" name="content" class="form-control">{{old('content')}}</textarea>
              </div>
  
              <button type="submit" class="btn btn-primary">Post</button>
            </form>
            <!-- /form -->
          </div>
  
        </div>
        <!-- /.row -->
  
      </div>
      <!-- /.container -->
  
</x-layout>