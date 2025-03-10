<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
    <meta name="author" content="">

    <title>Login - Blog Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('css/simple-blog-template.css')}}" rel="stylesheet">

  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Blog</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="/">Home</a>
              </li>
              <li>
                <a href="{{route('about')}}">About</a>
              </li>
              @auth
                <li>
                  <a href="{{route('logout')}}">Logout</a>
                </li>
                <li>
                  <a href="/posts">Posts</a>
                </li>
              @endauth
              @guest
                <li>
                  <a href="{{route('login')}}">Login</a>
                </li>
                <li>
                  <a href="{{route('register')}}">Sign up</a>
                </li>
              @endguest
            </ul>
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
      </nav>

    {{$slot}}

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright &copy; Blog @2024</p>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
    </div>
  </footer>

  <!-- jQuery -->
  <script src="{{asset('js/jquery.js')}}"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script>
    function addComment(postID , userID , username){
      let comment = document.getElementById("comment") ;
      let error = document.getElementById("error") ;
      let success = document.getElementById("success") ;
      const myHeaders = new Headers();
      myHeaders.append("X-CSRF-TOKEN", "{{csrf_token()}}");

      const urlencoded = new URLSearchParams();
      urlencoded.append("comment", comment.value);

      const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: urlencoded,
      };

      fetch(`/comments/${postID}/${userID}`, requestOptions)
        .then((response) => response.json())
        .then((result) => getDataComment(result , error , success , comment , username))
        .catch((error) => console.error(error));
    }
    function getDataComment(result , error , success , comment , username){
      let containerComment = document.getElementById("containerComment") ;
      if(result.errors){
        error.innerHTML = result.errors.comment ;
        success.style.display = "none" ;
      }else{
        function formatDateTime(date) {
        const options = {
            month: "long",
            day: "numeric",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            hour12: true
        };

        return new Intl.DateTimeFormat("en-US", options).format(date);
    }

    // استخدام الوقت الحالي
    const formattedDate = formatDateTime(new Date());
    console.log(formattedDate);
        success.innerHTML = result.success ;
        success.style.display = "block" ;
        containerComment.innerHTML = `
            <a class="pull-left" href="#">
              <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
              <h4 id="name" class="media-heading">${username}
                <small id="date">${formattedDate}</small>
              </h4>
              ${comment.value}
              <br><br>
            <div class="form-group">
              <label for="username">Reply</label>
              <input type="text" id="username" class="form-control"><br>
              <button type="button" class="btn btn-primary">Send Reply</button>
            </div><hr>` ;
          error.innerHTML = "" ;
          comment.value = "" ;
      }
    }
    function addSubComment(postID , userID , username , commentID){

      const subComment = document.getElementById("subComment");
      const myHeaders = new Headers();
      myHeaders.append("X-CSRF-TOKEN", "{{csrf_token()}}");

      const urlencoded = new URLSearchParams();
      urlencoded.append("subComment", subComment.value);

      const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: urlencoded,
      };

      fetch(`/comments/${postID}/${userID}/${commentID}`, requestOptions)
        .then((response) => response.json())
        .then((result) => getDataSubComment(result , commentID , username , subComment))
        .catch((error) => console.error(error));
    }
    function getDataSubComment(result , commentID , username , subComment){
      if(result.success){
        let reply = document.querySelector(`div[meta='reply-${commentID}']`);
        function formatDateTime(date) {
            const options = {
                month: "long",
                day: "numeric",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit",
                hour12: true
            };

            return new Intl.DateTimeFormat("en-US", options).format(date);
        }

        // استخدام الوقت الحالي
        const formattedDate = formatDateTime(new Date());
        reply.innerHTML = `
        <a class="pull-left" href="#">
              <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
              <h4 class="media-heading">${username}
                <small>${formattedDate}</small>
              </h4>
              ${subComment.value}
            </div>`
        subComment.value = '' ;
        let error = document.querySelector(`span[meta='error-${commentID}']`);
        error.innerHTML = ""
      }else if(result.errors){
        console.log(result.errors.subComment[0]) ;
        let error = document.querySelector(`span[meta='error-${commentID}']`);
        error.innerHTML = result.errors.subComment[0] ;
      }
    }
    function like(postID , userID){
        const myHeaders = new Headers();
        myHeaders.append("X-CSRF-TOKEN", "{{csrf_token()}}");

        const urlencoded = new URLSearchParams();

        const requestOptions = {
            method: "POST",
            headers: myHeaders,
        };

        fetch(`/like/${postID}/${userID}` , requestOptions)
            .then((response) => response.json())
            .then((result) => getDataLike(result , postID))
            .catch((error) => console.error(error));
    }
    function getDataLike(result , postID){
        let like = document.querySelector(`p[meta='like-${postID}']`);
        let count = document.querySelector(`span[meta='count-${postID}']`);
        // count = parseInt(count);
        result.liked? like.innerHTML = "unlike"   : like.innerHTML = "like" ;
        result.liked? count.innerHTML = +count.innerHTML + 1   : count.innerHTML = +count.innerHTML - 1  ;
    }
  </script>



</body>

</html>
