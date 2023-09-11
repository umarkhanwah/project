@extends('main')
@section('title')
   Patients Appointments - Covni
@endsection
@section('main')
   <div class="row">
      <div class="col-8 mx-auto">
         <div class="table-responsive">
            <table class="table table-striped
            table-hover	
            table-borderless
            table-primary
            align-middle">
               <thead class="table-dark">
                  <caption>Patients Tests</caption>
                  <tr>
                     <th>Patient Name</th>
                     <th>Patient Age</th>
                     <th>Patient Sex</th>
                     <th>Test Timings</th>
                     <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody class="table-group-divider">
                     @foreach($tests as $test)
                     <tr class="table-secondary" >
                        <td scope="row">{{$test->user->name}}</td>
                        <td>{{$test->user->age}}</td>
                        <td>{{$test->user->gender}}</td>
                        <td>{{$test->days." ".$test->timing}} </td>
                        <td>
                           <a href="#" class="btn btn-danger">Decline</a>
                           <a href="tests/report/{{$test->user->id}}" class="btn btn-success">Make Report</a>
                           </td>
                     </tr>
                     @endforeach
                  </tbody>
                  <tfoot>
                     
                  </tfoot>
            </table>
         </div>
         
      </div>
   </div>
@endsection