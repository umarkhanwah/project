@extends('main')
@section('title')
    Hospital Dashboard - Covni
@endsection
@section('main')

  <h1 class="text-light">  
    Hi
    @auth('hospital')
    {{ auth('hospital')->user()->name }}
    @endauth
    {{-- {{ Auth::guard('hospital')->user()->name}} --}}
</h1>  
<a href="/h_logout" class="btn btn-danger">Logout</a>
  
    
@endsection
@section('dropdown')
<a href="#dropdown" class="nav-link active dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
aria-expanded="false">
{{ auth('hospital')->user()->name }}

</a>
<div class="dropdown-menu" aria-labelledby="triggerId">
<a href="{{route('u_edit',auth('hospital')->user()->id)}}" class="dropdown-item" href="#">Edit Profile</a>
<a href="/u_logout" class="dropdown-item">Logout</a>
</div>   
@endsection
