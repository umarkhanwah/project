<!doctype html>
<html lang="en">

<head>
  <title>Hospital Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-dark text-light">
  <header>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs ms-auto w-25 mt-3" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <a href="/h_login" class="nav-link active" id="home-tab" type="button" role="tab" aria-controls="home" aria-selected="true">Login</a>
      </li>
      <li class="nav-item" role="presentation">
        <a href="/hospital" class="nav-link text-light" id="profile-tab"  type="button" role="tab" aria-controls="profile" aria-selected="false">Sign Up</a>
      </li>
 
    </ul>
    
    
    {{-- <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab"> home </div>
      <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab"> profile </div>
      <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab"> messages </div>
    </div> --}}
  </header>
  
  <main class="mt-5">

   
    <form action="h_login" method="Post">
        @csrf
        <div class="container">

            <div class="row">
            
              {{-- <div class="my-3 col-3"> --}}
        <div class="my-3 col-3">
          <label for="" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com">
          @if($errors->has('email'))
          <span class="text-danger">{{ $errors->first('email') }}</span>
          @else
          <small id="emailHelpId" class="form-text text-muted">Enter Your Email Here</small>
          @endif
    </div>
        <div class="my-3 col-3">
          <label for="" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password"  placeholder="Your Password Here">
          @if($errors->has('password'))
          <span class="text-danger">{{ $errors->first('password') }}</span>
          @else
          <small id="emailHelpId" class="form-text text-muted">Enter Your Password</small>
          @endif
    </div>
    <div class="my-5 col-1 ms-auto">
        <button type="submit" name="submit" class="btn btn-warning">Login</button>
    </div>
    </div>
    {{-- </div> --}}
    @if($message = Session::get('warning'))

    <div class="alert alert-warning">
    {{ $message }}
    </div>
    
    @endif
    </form>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>