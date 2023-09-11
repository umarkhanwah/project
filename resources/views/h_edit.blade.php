<!doctype html>
<html lang="en">

<head>
  <title>Edit Profile</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body  class="bg-dark text-light">
  <header>
    <ul class="nav nav-tabs  ms-auto w-25 mt-3" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <a href="/h_login" class="nav-link text-light disabled" id="home-tab" type="button" role="tab" aria-controls="home" aria-selected="true">Login</a>
      </li>
      <li class="nav-item" role="presentation">
        <a href="/hospital" class="nav-link  disabled" id="profile-tab"  type="button" role="tab" aria-controls="profile" aria-selected="false">Sign Up</a>
      </li>
 
    </ul>
  </header>
  <main>
    <form action="{{route('h_update')}}" method="POST">
      @csrf
      <div class="container">

          <div class="row">
            <input type="hidden" class="form-control" name="id" id="id" value="{{ $hospital->id }}"
                        placeholder="abc@mail.com">

            <div class="my-3 col-3">
              <label for="" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" id="name" value="{{ $hospital->name }}" placeholder="abc@mail.com">
              @error('name')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
           </div>

            <div class="my-3 col-3">
              <label for="" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email" value="{{ $hospital->email }}" placeholder="abc@mail.com">
              @error('email')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
             </div>

            <div class="my-3 col-3">
              <label for="" class="form-label">Phone</label>
              <input type="text" class="form-control" name="phone" id="phone" value="{{ $hospital->phone }}" placeholder="abc@mail.com">
              @error('phone')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
             </div>
            <div class="my-3 col-3 h-100">
              <label for="" class="form-label">Enter Adress</label>
              <textarea class="form-control h-100" name="adress" id="" rows="4">{{ $hospital->adress }}</textarea>
              @if($errors->has('adress'))
              <span class="text-danger">{{ $errors->first('adress') }}</span>
              @else
              <small id="emailHelpId" class="form-text text-muted">Enter Your Complete Adress Here</small>
              @endif
            </div>
            <div class="my-3 col-3">
              <label for="" class="form-label">Enter Country</label>
              <input type="text" class="form-control" name="country" id="country" value="{{ $hospital->country }}" placeholder="abc@mail.com">
              {{-- <small id="emailHelpId" class="form-text text-muted">Help text</small> --}}
            </div>
            <div class="my-3 col-3">
              <label for="" class="form-label">Enter City</label>
              <input type="text" class="form-control" name="city" id="city" value="{{ $hospital->city }}" placeholder="abc@mail.com">
              {{-- <small id="emailHelpId" class="form-text text-muted">Help text</small> --}}
            </div>
            <div class="my-3 col-3">
              <label for="" class="form-label">Enter province</label>
              <input type="text" class="form-control" name="province" id="province"value="{{ $hospital->province }}" placeholder="abc@mail.com">
              @error('province')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
            </div>
            <div class="my-3 col-3">
              <label for="" class="form-label">Set Password</label>
              <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" placeholder="abc@mail.com">
              @error('password')
              <small  class="form-text text-danger">{{ $message }}</small>
            @enderror
            </div>
            <div class="my-3 col-3">
              <label for="" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{old('password')}}" placeholder="abc@mail.com">
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