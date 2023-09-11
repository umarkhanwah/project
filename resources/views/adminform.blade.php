<!doctype html>
<html lang="en">

<head>
  <title>User Register</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body  class="bg-dark text-light">
  <header>
    <header>
      <ul class="nav nav-tabs  ms-auto w-25 mt-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a href="/u_login" class="nav-link text-light" id="home-tab" type="button" role="tab" aria-controls="home" aria-selected="true">Login</a>
        </li>
        <li class="nav-item" role="presentation">
          <a href="/user" class="nav-link active" id="profile-tab"  type="button" role="tab" aria-controls="profile" aria-selected="false">Sign Up</a>
        </li>
   
      </ul>
    </header>
  </header>
  <main>
    <form action="{{route('a_store')}}" method="POST">
      @csrf
      <div class="container">

          <div class="row">

            <div class="my-3 col-3">
              <label for="" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="abc@mail.com">
              @error('name')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
           </div>
           <div class="my-3 col-3">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="abc@mail.com">
            @error('email')
            <small  class="form-text text-danger">{{ $message }}</small>
          @enderror
           </div>

            <div class="my-3 col-3">
              <label for="" class="form-label">Enter your Age</label>
              <input type="number" class="form-control" name="age" id="age" value="{{old('age')}}" placeholder="abc@mail.com">
              @error('age')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
             </div>

                <div class="my-3 col-3 h-100">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select form-select-md" name="gender" id="gender">
                        <option selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('gender')
                    <small  class="form-text text-danger">{{ $message }}</small>
                  @enderror
                   </div>
                   <div class="my-3 col-3">
                    <label for="" class="form-label">Enter your Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}" placeholder="abc@mail.com">
                    @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @else
                    <small id="emailHelpId" class="form-text text-muted">Enter Your Complete Adress Here</small>
                    @endif
                    {{-- <small id="emailHelpId" class="form-text text-muted">Help text</small> --}}
                  </div>
            <div class="my-3 col-3 h-100">
              <label for="" class="form-label">Enter Adress</label>
              <textarea class="form-control h-100" name="adress" id="" rows="4"></textarea>
              @if($errors->has('adress'))
              <span class="text-danger">{{ $errors->first('adress') }}</span>
              @else
              <small id="emailHelpId" class="form-text text-muted">Enter Your Phone Number Here</small>
              @endif
            </div>
         
        
            <div class="my-3 col-3">
              <label for="" class="form-label">Set Password</label>
              <input type="text" class="form-control" name="password" id="password" value="{{old('password')}}" placeholder="abc@mail.com">
              @error('password')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
            </div>
            <div class="my-3 col-3">
              <label for="" class="form-label">Confirm Password</label>
              <input type="text" class="form-control" name="password_confirmation" id="password_confirmation" value="{{old('password')}}" placeholder="abc@mail.com">
              @error('password')
                <small  class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            
            <div class="col-1 my-5 ms-auto">

              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
      </div>

    
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