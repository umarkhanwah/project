
@extends('main')
@section('title')
    Home - Covni
@endsection
@section('main')
<div class="row">
    @php
    $shuffledTimings = $timings->shuffle();
    @endphp

    @foreach ($shuffledTimings as $timing)
    <!-- Display timing details -->
    <a href="#" class="timing-link text-decoration-none" data-timing-id="{{ $timing->id }}">
      
      
      <div class="col-12 mx-auto">
          <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">{{ $timing->hospital->name }}</h4>
            <p>Timing: {{ $timing->timing }} , Day: {{$timing->days}}</p>
            <hr>
            <p class="mb-0">Book Appointment For Covid Test</p>
          </div>
      </div>
    </a>
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirm Update</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form id="confirmForm" action="/update-timing/{{ $timing->timing }}" method="POST">
                @csrf
                <div class="modal-body">
                    Are you sure you want to Book this Timing for test?
                </div>
                <div class="modal-footer">
                  <a href="/"  class="btn btn-secondary">Cancel</a>
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="/">Cancel</button> --}}
                    <button type="submit" class="btn btn-primary" id="confirmButton">Confirm</button>
                </div>
            </form>
      </div>
    </div>
    </div>
  
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          const timingLinks = document.querySelectorAll(".timing-link");
  
          timingLinks.forEach(link => {
              link.addEventListener("click", function () {
                  const timingId = this.getAttribute("data-timing-id");
                  const confirmModal = new bootstrap.Modal(document.getElementById("confirmModal"));
  
                  // Show the modal
                  confirmModal.show();
  
                  // Handle "Confirm" button click
                  document.getElementById("confirmButton").addEventListener("click", function () {
                      // Perform AJAX request to update the timing record
                      fetch(`/update-timing/${timingId}`, {
                          method: 'POST',
                          headers: {
                              'X-CSRF-TOKEN': '{{ csrf_token() }}',
                              'Content-Type': 'application/json'
                          },
                          body: JSON.stringify({ timingId: timingId })
                      })
                      .then(response => response.json())
                      .then(data => {
                          // Handle the response
                          if (data.success) {
                              // Refresh the page or update the UI
                              window.location.reload();
                          }
                      });
                  });
              });
          });
      });
  </script>
  
    @endforeach
    {{ $timings->links('pagination::bootstrap-5') }}


   
  
  {{-- </div> --}}
</div>
  {{-- <h1>  
    Hi
    @auth('user')
    {{ auth('user')->user()->name}}
    
    @endauth
  </h1>   --}}



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
 