<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Hospital;
use App\Models\test_timing;
use App\Models\test_report;
use App\Models\User;
// use App\Models\test_timing;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{
    //
    public function create(){
        return view('adminform');
    }
    public function store(Request $req){
        $req->validate([
            'name'  => 'required',
            'email'  => 'required',
            'age'  => 'required',
            'gender'  => 'required',
            'phone'  => 'required | min:11 | max:11',
            'adress'  => 'required ',
            'password'  => 'required | min:6 | confirmed'
        ]);
        $input = $req->all();
        Admin::create([
            'name'  => $input['name'],
            'email'  => $input['email'],
            'age'  => $input['age'],
            'adress'  => $input['adress'],
            'gender'  => $input['gender'],
            'phone'  => $input['phone'],
            'password'  => Hash::make($input['password'])
        ]);
        return redirect('/a_login');
    }
    public function index(){
  
        if (Auth::guard('user')->check()) {
            // $timings = test_timing::whereNull('user_id')->get();
            $timings = test_timing::with('hospital') // Eager load the hospital relationship
            ->whereNull('user_id')
            ->paginate(10);
            return view('u_dashboard', compact('timings'));
        } 
        else if (Auth::guard('hospital')->check()) {
            $timings = test_timing::with('user') // Eager load the hospital relationship
            ->whereNull('user_id')
            ->get();
            return view('h_dashboard');
        } 
        else if (Auth::guard('admin')->check()) {
            $hospitals = Hospital::all();
            $users = User::all();
            $timings = test_timing::with('user','hospital') // Eager load the hospital relationship
            ->whereNotNull('user_id')
            ->get();
            $reports = test_report::with('user','hospital') // Eager load the hospital relationship
            ->get();
            return view('a_dashboard',compact('hospitals', 'users','timings','reports'));
        }
         else {
            return redirect('/allroles');
        }
    }
    public function timingPDF()
    {
        // Fetch the test report data from the database
        // $testReports = Test_report::all(); // Assuming you want to fetch all test reports
        $test_timings = Test_timing::with('user', 'hospital')->whereNotNull('user_id')->get();

        // Load the view with the data
        $pdf = PDF::loadView('pdf.test_timings', compact('test_timings'));
        
        // To save the PDF to a specific directory within the storage/app/ directory:
        $pdfPath = public_path('pdf/test_timings.pdf');

        // Save the PDF to the public folder
        Storage::put('pdf/test_reports.pdf', $pdf->output());

        // To return the PDF as a response:
        return $pdf->stream('test_timings.pdf');
    }
    public function reportPDF()
    {
        // Fetch the test report data from the database
        // $testReports = Test_report::all(); // Assuming you want to fetch all test reports
        $testReports = Test_report::with('user', 'hospital')->get();

        // Load the view with the data
        $pdf = PDF::loadView('pdf.test_report', compact('testReports'));
        
        // To save the PDF to a specific directory within the storage/app/ directory:
        $pdfPath = public_path('pdf/test_reports.pdf');

        // Save the PDF to the public folder
        Storage::put('pdf/test_reports.pdf', $pdf->output());

        // To return the PDF as a response:
        return $pdf->stream('test_reports.pdf');
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
            return view('a_login');
        }
    }
    public function login(Request $request){
        $request->validate([
            'phone' =>  'required',
            'password'  =>  'required'
        ]);
        
    // $credentials = $request->only('email', 'password');
        // if(Auth::attempt($credentials))
    //     if(Auth::guard('admin')->attempt($credentials))
    // {
    //         return redirect('/');
    //     }
    if (Auth::guard('admin')->attempt($request->only('phone', 'password'))) {
        return redirect('/');
    }
    // dd($credentials);
        return redirect('/a_login')->with('warning', 'Email or password is incorrect');
    
    }
    function logout()
    {
        // Session::flush();
        

        // Auth::logout();
        // Auth::guard('hospital')->logout();
        Auth::guard('admin')->logout();
        return Redirect('/');
    }
  
}
