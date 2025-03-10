<x-layout>
  <!-- Page Content -->
  <div class="container">
  
    <div class="row">

      <div class="col-lg-2"></div>

      <!-- Signup content  -->
      <div class="col-lg-8 signup">

        <!-- Title -->
        <h1>Sign up</h1>

        <!-- Login form -->
        <form action="{{route('register')}}" method="POST" class="signup-form">
            @csrf
          <div class="form-group">
            <label for="username">Username</label>
            @error('username')
                <p style="color:red">{{$message}}</p>
            @enderror
            <input type="text" value="{{old('username')}}" id="username" name="username" class="form-control" >
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            @error('password')
                <p style="color:red">{{$message}}</p>
            @enderror
            <input type="password" id="password" name="password" class="form-control" >
          </div>

          <div class="form-group">
            <label for="password">Password Confirmation</label>
            <input type="password" id="confirmation" name="password_confirmation" class="form-control">
          </div>

          <div class="form-group">
            <label for="username">Email</label>
            @error('email')
                <p style="color:red">{{$message}}</p>
            @enderror
            <input value="{{old('email')}}" type="email" id="email" name="email" class="form-control" >
          </div>
          <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
        <!-- /form -->
      </div>

      <div class="col-lg-2"></div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

</x-layout>
      