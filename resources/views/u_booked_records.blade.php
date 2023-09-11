@extends('main')
@section('title')
   Booked Appointments - Covni
@endsection
@section('main')

<div class="table-responsive">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Hospital Name</th>
                <th scope="col">Timings</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tests as $test)
                
            <tr class="table-light">
                <td scope="row">{{$test->hospital->name}}</td>
                <td>{{$test->timing}}</td>
                <td><a href="/delete_timing/{{$test->id}}" onclick="return confirm('It will Cancel Your Booking from Hospital,      Ok?')" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection
@section('dropdown')
<a href="#dropdown" class="nav-link active dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false">
    {{ auth('user')->user()->name }}
  
    </a>
<div class="dropdown-menu" aria-labelledby="triggerId">
  <a href="{{route('u_edit',auth('user')->user()->id)}}" class="dropdown-item" href="#">Edit Profile</a>
  <a href="/u_logout" class="dropdown-item">Logout</a>
</div>    
@endsection