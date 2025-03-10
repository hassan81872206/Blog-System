<x-layout>
  <!-- Page Content -->
  <div class="container">
  
    <div class="row">

      <div class="col-lg-2"></div>

      <!-- Login content  -->
      <div class="col-lg-8 login">

        <!-- Title -->
        <h1>Login</h1>

        <!-- Login form -->
        <form action="{{route('login')}}" method="POST" class="login-form">
          @csrf
          <div class="form-group">
            <label for="username">Email</label>
            @error('email')
                <p style="color:red">{{$message}}</p>
            @enderror
            <input value="{{old('email')}}" type="email" id="username" name="email" class="form-control">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            @error('password')
                <p style="color:red">{{$message}}</p>
            @enderror
            <input type="password" id="password" name="password" class="form-control">
          </div>

          <button type="submit" class="btn btn-primary">Log in</button>
          @if (session('msg'))
              <p style="color:red">{{session('msg')}}</p>
          @endif
          <p>Don't have an account? <a href="{{route('register')}}">Sign Up Now</a></p>
        </form>
        <!-- /form -->
      </div>

      <div class="col-lg-2"></div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

</x-layout>
      