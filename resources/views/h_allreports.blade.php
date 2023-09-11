
@extends('main')
@section('main')
    
<div class="row">

    @foreach ($test_reports as $test_report)

    <div class="col-4">
        <div class="card">
            <div class="card-header">
                Test Report
            </div>
            <div class="card-body">
                {{-- <img src="app/{{ $test_report->pdf_path }}" alt=""><p>{{ $test_report->pdf_path }}</p> --}}
                <embed src="app/{{ $test_report->pdf_path }}" type="application/pdf" width="100%" height="">
                    <p>{{ $test_report->pdf_path }}</p> 
                <!-- Display the PDF as an image by setting the 'src' attribute to the route -->
                {{-- <img src="{{ route('test-report-pdf-image', ['testReportId' => $test_report->id]) }}" alt="PDF as Image" class="img-fluid"> --}}
            </div>
            <div class="card-footer">
                Vaccination: {{ $test_report->vaccination }}<br>
                Status: {{ $test_report->status }}
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection