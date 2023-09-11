<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\test_timing;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\Storage;
use App\Models\test_report;

class hospitalController extends Controller
{
  
    public function create(){
        return view('hospitalform');
    }
    public function store(Request $req){
        $req->validate([
            'name'  => 'required',
            'email'  => 'required | email | unique',
            'phone'  => 'required | min:11 | max:11',
            'adress'  => 'required ',
            'country'  => 'required ',
            'city'  => 'required ',
            'province'  => 'required ',
            'password'  => 'required | min:6 | confirmed'
        ]);
        $input = $req->all();
        Hospital::create([
            'name'  => $input['name'],
            'email'  => $input['email'],
            'phone'  => $input['phone'],
            'adress'  => $input['adress'],
            'country'  => $input['country'],
            'city'  => $input['city'],
            'province'  => $input['province'],
            'password'  => Hash::make($input['password'])
        ]);
        return redirect('/h_login');
    }
    public function login_view(Request $request){
        if(Auth::guard('hospital')->check()){
            return redirect('/');
        }
        else if(Auth::guard('user')->check()){
            return redirect('/');
        }
        else if(Auth::guard('admin')->check()){
            return redirect('/');
        }
        else{
            return view('h_login');
        }
    }
    public function login(Request $request){
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);
        $credentials = $request->only('email', 'password');

        // if(Auth::attempt($credentials))
        if(Auth::guard('hospital')->attempt($credentials))
        {
            return redirect('/');
        }

        return redirect('/h_login')->with('warning', 'Email or password is incorrect');
    
    }
    public function edit($id){
        $hospital = hospital::find($id);
        return view('h_edit', compact('hospital'));
    }
    public function update(Request $req){
     $req->validate([
            'name'  => 'required',

            'email'  => 'required | email ',
            // 'email'  => 'required | email | unique',
            'phone'  => 'required | min:11 | max:11',
            'adress'  => 'required ',
            'country'  => 'required ',
            'city'  => 'required ',
            'province'  => 'required ',
            'password'  => 'required | min:6 | confirmed'
        ]);
       
        $hospital = hospital::findOrFail($req->id); // Find the user by ID

        $input = $req->all();
        $hospital->update([
            'name'  => $input['name'],
            'email'  => $input['email'],
            'phone'  => $input['phone'],
            'adress'  => $input['adress'],
            'country'  => $input['country'],
            'city'  => $input['city'],
            'province'  => $input['province'],
            'password'  => Hash::make($input['password'])
        ]);
        return redirect('/');
    }
    function logout()
    {
        // Session::flush();

        // Auth::logout();
        // Auth::guard('hospital')->logout();
        Auth::guard('hospital')->logout();
        return Redirect('/');
    }
       
    public function tests(){
        if(Auth::guard('hospital')->check()){
            // Select all records where 'user_id' is not null and eager load the user data
            $tests = test_timing::whereNotNull('user_id')->with('user')->get();
            return view('h_tests', compact('tests'));
        }
    }
    
    public function report_view($user_id)
    {
        $hosp_id = Auth::guard('hospital')->user()->id; // Get the logged-in hospital's ID

        // Fetch the test record for the user and hospital
        $test = test_timing::where('user_id', $user_id)
            ->where('hosp_id', $hosp_id)
            ->first();

        if (!$test) {
            // logout();
            // Handle the case where the test record is not found, possibly show an error message or redirect.
        }

        // Load the 'h_report.blade.php' view and pass the user_id and hospital_id to it
        return view('h_report', [
            'user_id' => $user_id,
            'hosp_id' => $hosp_id,
        ]);
    }


    // public function generatePDF(Test_report $testReport)
    // {
    //     // Fetch the test report data from the database using the provided $testReport instance
    //     $pdf = PDF::loadView('pdf.test_report', compact('testReport'));

    //     // To save the PDF to a specific directory within the storage/app/ directory:
    //         $pdfPath = public_path('pdf/' . $testReport->id . '_test_report.pdf');

    //     // $pdf->save(storage_path($pdfPath));

    //     // Save the PDF to the public folder
    //     Storage::put('pdf/' . $testReport->id . '_test_report.pdf', $pdf->output());        // To return the PDF as a response:
    //     return $pdf->stream('test_report.pdf');
    // }
    
    public function generatePDF()
    {
        // Fetch the test report data from the database
        $hosp_id=Auth::guard('hospital')->user()->id;
        // $testReports = Test_report::all(); // Assuming you want to fetch all test reports
        $testReports = Test_report::with('user', 'hospital')->where('hosp_id',$hosp_id)->get();

        // Load the view with the data
        $pdf = PDF::loadView('pdf.test_report', compact('testReports'));
        
        // To save the PDF to a specific directory within the storage/app/ directory:
        $pdfPath = public_path('pdf/test_reports.pdf');

        // Save the PDF to the public folder
        Storage::put('pdf/test_reports.pdf', $pdf->output());

        // To return the PDF as a response:
        return $pdf->stream('test_reports.pdf');
    }
    public function createTestReport(Request $request)
    {
        $testReport = new test_report;
        $testReport->hosp_id = $request->input('hosp_id'); 
        $testReport->user_id = $request->input('user_id'); 
        $testReport->status = $request->input('status');
        $testReport->vaccination = $request->input('vaccination'); 
            // Save the TestReport record first to generate an ID
        $testReport->save();

        // Generate the PDF report for the newly created test report
        $generatedPdf = $this->generatePDF($testReport);

        // Update the test report record with the PDF path
        $pdfPath = 'pdf/' . $testReport->id . '_test_report.pdf';
        $testReport->pdf_path = $pdfPath;
        $testReport->save();

        return redirect('tests');
    }
  

//  ----------------------------------- Daaaaammnnnn CHat GPT--------------------------------------
        // public function generatePDF(Request $request)
        // {
        //     // Fetch data or create a new TestReport instance
        //     $testReport = Test_report::findOrNew($request->input('test_report_id'));
            
        //     // Populate the testReport object with your data as needed
        //     // Example: $testReport->status = $request->input('status');
            
        //     // Generate PDF
        //     $pdf = PDF::loadView('test_report_pdf', compact('testReport'));

        //     // Define a file name for the PDF (you can customize this)
        //     $pdfFileName = 'test_report_' . $testReport->id . '.pdf';

        //     // Save the PDF to a temporary location
        //     $pdfPath = storage_path('app/pdf/' . $pdfFileName);
        //     $pdf->save($pdfPath);

        //     // Optionally, you can store the PDF path in your database
        //     $testReport->pdf_path = $pdfPath;
        //     $testReport->save();

        //     // Return the PDF as a download response
        //     return response()->download($pdfPath, $pdfFileName)->deleteFileAfterSend(true);
        // }

        
        
        
        // public function generatePDF(Request $request)
        // {
        //     // Fetch data or create a new TestReport instance
        //     $testReport = TestReport::findOrNew($request->input('test_report_id'));
            
        //     // Populate the testReport object with your data as needed
        //     // Example: $testReport->status = $request->input('status');
            
        //     // Generate PDF
        //     $pdf = PDF::loadView('test_report_pdf', compact('testReport'));
        
        //     // Define a file name for the PDF (you can customize this)
        //     $pdfFileName = 'test_report_' . $testReport->id . '.pdf';
        
        //     // Save the PDF using Laravel's storage system
        //     Storage::put('pdf/' . $pdfFileName, $pdf->output());
        
        //     // Optionally, you can store the PDF path in your database
        //     $testReport->pdf_path = 'pdf/' . $pdfFileName;
        //     $testReport->save();
        
        //     // Return the PDF as a download response
        //     return response()->download(storage_path('app/pdf/' . $pdfFileName), $pdfFileName)->deleteFileAfterSend(true);
        // }
        //         public function createTestReport(Request $request)
        // {
        //     $testReport = new test_report;
        //     $testReport->hosp_id = $request->input('hosp_id'); 
        //     $testReport->user_id = $request->input('user_id'); 
        //     $testReport->status = $request->input('status');
        //     $testReport->vaccination = $request->input('vaccination'); 

        //     // Save the TestReport record first to generate an ID
        //     $testReport->save();

        //     // Generate PDF
        //     $pdf = PDF::loadView('test_report_pdf', compact('testReport'));

        //     // Define a file name for the PDF (you can customize this)
        //     $pdfFileName = 'test_report_' . $testReport->id . '.pdf';

        //     // Specify the path within the public folder where you want to save the PDF
        //     // $pdfFilePath = public_path().'pdf/' . $pdfFileName;
        //     $publicPath = public_path();
        //     $pdfRelativePath = 'pdf/';
        //     $pdfDestination = public_path($pdfRelativePath);
        //     Storage::put($pdfRelativePath . $pdfFileName, $pdf->output());

        //     // Save the PDF to the public folder using Laravel's storage system
        //     // Storage::put($pdfFilePath, $pdf->output());

        //     // Optionally, you can store the PDF path in your database
        //     $testReport->pdf_path = $pdfDestination;
        //     $testReport->save();

        //     return redirect('/tests');
        // }

        // Saving in Storage folder
        // public function createTestReport(Request $request)
        // {
        
        //     $testReport = new test_report;
        //     $testReport->hosp_id = $request->input('hosp_id'); 
        //     $testReport->user_id = $request->input('user_id'); 
        //     $testReport->status = $request->input('status');
        //     $testReport->vaccination = $request->input('vaccination'); 
            
        //     // Save the TestReport record first to generate an ID
        //     $testReport->save();

        
        //         // Generate PDF
        //     $pdf = PDF::loadView('test_report_pdf', compact('testReport'));
        
        //     // Define a file name for the PDF (you can customize this)
        //     $pdfFileName = 'test_report_' . $testReport->id . '.pdf';
        
        //     // Save the PDF using Laravel's storage system
        //     Storage::put('pdf/' . $pdfFileName, $pdf->output());
        
        //     // Optionally, you can store the PDF path in your database
        //     $testReport->pdf_path = 'pdf/' . $pdfFileName;
        //     $testReport->save();
            
        //     // Get the image path
        //     // $imagePath = $this->displayTestReportPdfImage($testReport->pdf_path);

        //     // Pass the image path to your view
        //     // return view('h_allreports', ['imagePath' => $imagePath]);
        //     return redirect('/tests');
        // }
        // public function displayTestReportPdfImage($testReportId)
        // {
        //     // Fetch the test report from the database based on its ID
        //     $testReport = Test_report::find($testReportId);
        
        //     if (!$testReport) {
        //         abort(404); // Handle the case where the test report is not found
        //     }
        
        //     // Generate the PDF using Laravel's PDF package
        //     $pdf = PDF::loadView('test_report_pdf', compact('testReport'));
        
        //     // Convert the PDF to a base64-encoded image
        //     $pdfData = $pdf->output();
        //     $base64Image = 'data:image/jpeg;base64,' . base64_encode($pdfData);
        
        //     // Return the image as a response with the appropriate content type
        //     return Response::make($base64Image)->header('Content-Type', 'image/jpeg');
        //     // return Response::make($pdfData)->header('Content-Type', 'application/pdf');

        // }
        
        // public function displayPdfAsImage($pdfPath)
        // {
        //     $pdf = new Pdf(storage_path('app/' . $pdfPath));
        //     $imagePath = storage_path('app/pdf/') . pathinfo($pdfPath, PATHINFO_FILENAME) . '.jpg';
        //     $pdf->setOutputFormat('jpg')->saveImage($imagePath);

        //     return $imagePath;
        // }





        public function pdfs(){
            $test_reports = test_report::all();
            return view('h_allreports',compact('test_reports'));
        }


       
        












    public function updatePermissions(Request $request)
    {
        $permissions = $request->input('permissions');
        
        if ($permissions) {
            foreach ($permissions as $hospitalId => $permissionValue) {
                $hospital = Hospital::find($hospitalId);
                
                if ($hospital) {
                    $hospital->permission = $permissionValue === 'yes' ? 'yes' : 'no';
                    $hospital->save();
                }
            }
            
            return redirect()->back()->with('success', 'Permissions updated successfully.');
        } else {
            return redirect()->back()->with('error', 'No permissions data received.');
        }
    }
 

    
    // public function updatePermissions(Request $request)
    // {
    //     $permissions = $request->input('permission');
    
    //     foreach ($permissions as $hospitalId => $permissionValue) {
    //         $hospital = Hospital::find($hospitalId);
    //         if ($hospital) {
    //             $hospital->permission = $permissionValue ? 'yes' : 'no';
    //             $hospital->save();
    //         }
    //     }
    
    //     return redirect()->back()->with('success', 'Permissions updated successfully.');
    // }
    
    
}
