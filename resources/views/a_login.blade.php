<!doctype html>
<html lang="en">

<head>
  <title>Admin Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-dark text-light">
  <header>
      <ul class="nav nav-tabs  ms-auto w-25 mt-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a href="/a_login" class="nav-link active" id="home-tab" type="button" role="tab" aria-controls="home" aria-selected="true">Login</a>
        </li>
        <li class="nav-item" role="presentation">
          <a href="/admin" class="nav-link disabled"  id="profile-tab"  type="button" role="tab" aria-controls="profile" aria-selected="false">Sign Up</a>
        </li>
   
      </ul>
  </header>
  <main>

   
    <form action="a_login" method="Post">
        @csrf
        <div class="container">

            <div class="row">
            
              {{-- <div class="my-3 col-3"> --}}
        <div class="my-3 col-3">
          <label for="" class="form-label">phone</label>
          <input type="text" class="form-control" name="phone" id="phone" aria-describedby="emailHelpId" placeholder="abc@mail.com">
          @if($errors->has('phone'))
          <span class="text-danger">{{ $errors->first('phone') }}</span>
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