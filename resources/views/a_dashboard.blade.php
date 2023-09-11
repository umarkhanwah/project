<!doctype html>
<html lang="en">

<head>
  <title>Admin Dashboard</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main >
    <div class="container">
        <div class="row">
<div class="btn-group ms-auto col-1">
  <button class="btn btn-outline-dark dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
      aria-expanded="false">
      @auth('admin')
      {{ auth('admin')->user()->name }}
      @endauth
  </button>
  <div class="dropdown-menu dropdown-menu-start" aria-labelledby="triggerId">
    <a class="dropdown-item" href="/a_logout">Logout</a>

  </div>
</div>
            <h1 class="display-6 text-center">  
              You are An Admin ..!  
              {{-- Hi
                @auth('admin')
                {{ auth('admin')->user()->name }}
                @endauth --}}
            </h1>
            </div>

                <div class="row">
                        <div class="col-12">
                            <form action="{{ route('update.permissions') }}" method="post">
                                @csrf
                                      <table class="table table-responsive">
                                          <thead class="table-dark">
                                              <caption class="text-center text-uppercase">Hospitals</caption>
                                              <tr>
                                                  <th>ID</th>
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Country</th>
                                                  <th>City</th>
                                                  <th>Address</th>
                                                  <th>Permission</th>
                                              </tr>
                                              </thead>
                                              <tbody class="table-group-divider">
                                                  @foreach ($hospitals as $h)
                                                  <tr class="table-light" >
                                                      <td scope="row">{{$loop->index+1}}</td>
                                                      <td>{{$h->name}}</td>
                                                      <td>{{$h->email}}</td>
                                                      <td>{{$h->country}}</td>
                                                      <td>{{$h->city}}</td>
                                                      <td>{{$h->adress}}</td>
                                                      <td>
                                                                                          {{-- Failed Practices --}}
                                                                                          {{-- <form action="" method="post">

                                                                                              <div class="form-check form-switch">
                                                                                                  <input class="form-check-input" type="checkbox" name="permission" id="flexSwitchCheckDefault">
                                                                                                  <label class="form-check-label" for="flexSwitchCheckDefault">Confirm Hospital Registration</label>
                                                                                              </div>
                                                                                              
                                                                                          </form> --}}
                                                                                          {{-- <form action="{{ route('update.permissions') }}" method="post">

                                                                                              @csrf --}}
                                                                                              {{-- <div class="form-check form-switch">
                                                                                                  
                                                                                                  <input class="form-check-input" type="checkbox" name="permission[{{$h->id}}]" id="permission{{$h->id}}" {{ $h->permission ? 'checked' : '' }}>
                                                                                                  <label class="form-check-label" for="flexSwitchCheckDefault">Confirm Hospital Registration</label>
                                                                                                </div> --}}
                                                                                                {{-- <div class="form-check form-switch">
                                                                                                  <input type="hidden" name="permissions[{{ $h->id }}]" value="no">
                                                                                                  <form action="{{ route('update.permissions') }}" method="post">
                                                                                                    @csrf
                                                                                                    <button type="submit" >
                                                                                                      <input class="" type="checkbox" name="permissions[{{ $h->id }}]" id="permission_{{ $h->id }}" value="yes" @if ($h->permission == 'yes') checked @endif>
                                                                                                      
                                                                                                    </button>
                                                                                                  </form>
                                                                                              </div> --}}
                                                          <div class="form-check form-switch">
                                                              <input type="hidden" name="permissions[{{ $h->id }}]" value="no">
                                                            
                                                              <input class="form-check-input" type="checkbox" name="permissions[{{ $h->id }}]" id="permission_{{ $h->id }}" value="yes" @if ($h->permission == 'yes') checked @endif>
                                                              <label class="form-check-label" for="permission_{{ $h->id }}">Confirm Hospital Registration</label>
                                                          </div>
                                                
                                                          
                                                      </td>
                                                  </tr>
                                                      
                                                  @endforeach
                                          
                                              </tbody>
                                      </table>
                                      <button type="submit" class="btn btn-info float-end">Update Permissions</button>
                            </form>
                     
                        </div>

                </div>
                <div class="row">
                        <div class="col-12">

                                      <table class="table table-responsive">
                                          <thead class="table-dark">
                                            <caption class="text-center text-uppercase">Patients</caption>
                                            <tr>
                                                <th>ID</th>
                                                <th>Patient Name</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Phone No</th>
                                                <th>Address</th>
                                                <th>Actions</th>
                                                {{-- <th>Permission</th> --}}
                                            </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                @foreach ($users as $u)
                                                <tr class="table-light" >
                                                    <td scope="row">{{$loop->index+1}}</td>
                                                    <td>{{$u->name}}</td>
                                                    <td>{{$u->age}}</td>
                                                    <td>{{$u->gender}}</td>
                                                    <td>{{$u->phone}}</td>
                                                    <td>{{$u->adress}}</td>
                                                    <td><a href="{{route('u_edit',$u->id)}}" class="btn btn-info">Edit</a>
                                                      <form action="/u_delete" class="d-inline" method="POST">
                                                        @csrf
                                                      <input type="hidden" name="id" value="{{$u->id}}">
                                                     <button type="submit" class="btn btn-danger">Delete</button>
                                                      </form>
                                                    </td>
                                                    <td>
                                                        {{-- 
                                                          {{-- <form action="" method="post">

                                                              <div class="form-check form-switch">
                                                                  <input class="form-check-input" type="checkbox" name="permission" id="flexSwitchCheckDefault">
                                                                  <label class="form-check-label" for="flexSwitchCheckDefault">Confirm Hospital Registration</label>
                                                              </div>
                                                              
                                                          </form> --}}
                                                     
                                                              {{-- <div class="form-check form-switch">
                                                                  
                                                                  <input class="form-check-input" type="checkbox" name="permission[{{$h->id}}]" id="permission{{$h->id}}" {{ $h->permission ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="flexSwitchCheckDefault">Confirm Hospital Registration</label>
                                                                </div> --}}
                                                                {{-- <div class="form-check form-switch">
                                                                  <input type="hidden" name="permissions[{{ $h->id }}]" value="no">
                                                                  <form action="{{ route('update.permissions') }}" method="post">
                                                                    @csrf
                                                                    <button type="submit" >
                                                                      <input class="" type="checkbox" name="permissions[{{ $h->id }}]" id="permission_{{ $h->id }}" value="yes" @if ($h->permission == 'yes') checked @endif>
                                                                      
                                                                    </button>
                                                                  </form>
                                                              </div> --}}
                                                              {{-- <div class="form-check form-switch">
                                                                  <input type="hidden" name="permissions[{{ $h->id }}]" value="no">
                                                                
                                                                  <input class="form-check-input" type="checkbox" name="permissions[{{ $h->id }}]" id="permission_{{ $h->id }}" value="yes" @if ($h->permission == 'yes') checked @endif>
                                                                  <label class="form-check-label" for="permission_{{ $h->id }}">Confirm Hospital Registration</label>
                                                              </div> --}}
                                                
                                                          
                                                      </td>
                                                  </tr>
                                                      
                                                  @endforeach
                                          
                                              </tbody>
                                      </table>
                         
                     
                        </div>

                </div>
                <div class="row">
                        <div class="col-12">

                                      <table class="table table-responsive">
                                          <thead class="table-dark">
                                            <caption class="text-center text-uppercase">Reports</caption>
                                            <td><a href="{{route('r_download')}}" class="btn btn-info float-end">Download All</a>

                                            <tr>
                                                <th>ID</th>
                                                <th>Patient Name</th>
                                                <th>Hospital</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Report</th>
                                                <th>Needed Vaccination</th>
                                                <th>PDF</th>
                                                {{-- <th>Permission</th> --}}
                                            </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                @foreach ($reports as $r)
                                                <tr class="table-light" >
                                                    <td scope="row">{{$loop->index+1}}</td>
                                                    <td>{{$r->user->name}}</td>
                                                    <td>{{$r->hospital->name}}</td>
                                                    <td>{{$r->user->age}}</td>
                                                    <td>{{$r->user->gender}}</td>
                                                    <td>{{$r->status}}</td>
                                                    <td>{{$r->vaccination}}</td>
                                                    <td><a href="{{route('u_download',$r->id)}}" class="btn btn-info">Download</a>
                                                      {{-- <form action="/u_delete" class="d-inline" method="POST">
                                                        @csrf
                                                      <input type="hidden" name="id" value="{{$r->id}}">
                                                     <button type="submit" class="btn btn-danger">Delete</button>
                                                      </form> --}}
                                                    </td>
                                                    <td>
                                                        {{-- 
                                                          {{-- <form action="" method="post">

                                                              <div class="form-check form-switch">
                                                                  <input class="form-check-input" type="checkbox" name="permission" id="flexSwitchCheckDefault">
                                                                  <label class="form-check-label" for="flexSwitchCheckDefault">Confirm Hospital Registration</label>
                                                              </div>
                                                              
                                                          </form> --}}
                                                     
                                                              {{-- <div class="form-check form-switch">
                                                                  
                                                                  <input class="form-check-input" type="checkbox" name="permission[{{$h->id}}]" id="permission{{$h->id}}" {{ $h->permission ? 'checked' : '' }}>
                                                                  <label class="form-check-label" for="flexSwitchCheckDefault">Confirm Hospital Registration</label>
                                                                </div> --}}
                                                                {{-- <div class="form-check form-switch">
                                                                  <input type="hidden" name="permissions[{{ $h->id }}]" value="no">
                                                                  <form action="{{ route('update.permissions') }}" method="post">
                                                                    @csrf
                                                                    <button type="submit" >
                                                                      <input class="" type="checkbox" name="permissions[{{ $h->id }}]" id="permission_{{ $h->id }}" value="yes" @if ($h->permission == 'yes') checked @endif>
                                                                      
                                                                    </button>
                                                                  </form>
                                                              </div> --}}
                                                              {{-- <div class="form-check form-switch">
                                                                  <input type="hidden" name="permissions[{{ $h->id }}]" value="no">
                                                                
                                                                  <input class="form-check-input" type="checkbox" name="permissions[{{ $h->id }}]" id="permission_{{ $h->id }}" value="yes" @if ($h->permission == 'yes') checked @endif>
                                                                  <label class="form-check-label" for="permission_{{ $h->id }}">Confirm Hospital Registration</label>
                                                              </div> --}}
                                                
                                                          
                                                      </td>
                                                  </tr>
                                                      
                                                  @endforeach
                                          
                                              </tbody>
                                      </table>
                         
                     
                        </div>

                </div>
            
{{-- <a href="/a_logout" class="btn btn-danger">Logout</a> --}}

            {{-- {{ Auth::guard('hospital')->user()->name}} --}}
    
    </div>
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