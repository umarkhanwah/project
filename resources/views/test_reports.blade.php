@extends('main')
@section('main')
    <div class="row">                        
        @foreach($testReports as $reports)
            <div class="col-4 my-4">
                <div class="card text-start {{ $reports->status === 'Positive' ? 'bg-danger' : 'bg-info' }}">

                {{-- <img class="card-img-top" src="holder.js/100px180/" alt="Title"> --}}
                <div class="card-body">
                    <h4 class="card-title">Status: {{$reports->status}}</h4>
                    <p class="card-text">Vaccination: {{$reports->vaccination}}</p>
                     {{-- Embed the PDF using an iframe --}}
                     {{-- <iframe src="{{ asset('pdf/u_report.pdf') }}" width="100%" height="400"></iframe> --}}
                     <iframe src="{{ public_path('app/pdf/u_report.pdf') }}" ></iframe>
                     <a href="/u_report/{{$reports->id}}" class="btn btn-primary">Download PDF</a>
                </div>
                </div>
            </div>                           
         @endforeach
        <div class="col-8 mx-auto">
            <div class="table-responsive">
                <table class="table table-striped
                table-hover	
                table-borderless
                table-primary
                align-middle">
                    <thead class="table-light">
                        <caption>Reports</caption>
                        <tr>
                            <th>Patient Name</th>
                            <th>Status</th>
                            <th>Vaccination</th>
                            <th>PDF</th>
                        </tr>
                        </thead>
                        {{-- @php
dd($testReports);
@endphp --}}
                        <tbody class="table-group-divider">
                        @foreach($testReports as $reports)
                            <tr class="table-primary">
                                <td scope="row">{{$reports->user->name}}</td>
                                <td>{{$reports->status}}</td>
                                <td>{{$reports->vaccination}}</td>
                                <td><a href="/u_report/{{$reports->id}}" class="btn btn-primary">Download</a></td>
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