<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\test_timing;
use App\Models\Test_report;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\Storage;


class userController extends Controller
{
    // public function index(){
    //     if(Auth::guard('user')->id()){
    //         return view('u_dashboard');
    //     }
    //     else if(Auth::guard('hospital')->id()){
    //         return view('h_dashboard');
    //     }
    //     else{
    //         return redirect('/u_login');
    //     }
    // }
    public function create(){
        return view('userform');
    }
    public function store(Request $req){
        $req->validate([
            'name'  => 'required',
            'age'  => 'required',
            'gender'  => 'required',
            'phone'  => 'required | min:11 | max:11',
            'adress'  => 'required ',
            'password'  => 'required | min:6 | confirmed'
        ]);
        $input = $req->all();
        User::create([
            'name'  => $input['name'],
            'age'  => $input['age'],
            'adress'  => $input['adress'],
            'gender'  => $input['gender'],
            'phone'  => $input['phone'],
            'password'  => Hash::make($input['password'])
        ]);
        return redirect('/u_login');
    }
    public function edit($id){
        $user = User::find($id);
        return view('u_edit', compact('user'));
    }
    public function update(Request $req){
        $req->validate([
            'name'  => 'required',
            'age'  => 'required',
            'gender'  => 'required',
            'phone'  => 'required | min:11 | max:11',
            'adress'  => 'required ',
            'password'  => 'required | min:6 | confirmed'
        ]);
       
        $user = User::findOrFail($req->id); // Find the user by ID

        $input = $req->all();
        $user->update([
            'name'     => $input['name'],
            'age'      => $input['age'],
            'adress'   => $input['adress'],
            'gender'   => $input['gender'],
            'phone'    => $input['phone'],
            'password' => Hash::make($input['password'])
        ]);
        return redirect('/');
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
            return view('u_login');
        }
    }
    public function login(Request $request){
        $request->validate([
            'phone' =>  'required',
            'password'  =>  'required'
        ]);
        $credentials = $request->only('phone', 'password');

        // if(Auth::attempt($credentials))
        if(Auth::guard('user')->attempt($credentials))
    {
        return redirect('/');
    }
    
    // dd($credentials);
        return redirect('/u_login')->with('warning', 'Phone or password is incorrect');
    
    }
    function logout()
    {
        // Session::flush();

        // Auth::logout();
        // Auth::guard('hospital')->logout();
        Auth::guard('user')->logout();
        return Redirect('/');
    }
   
    function delete(Request $req)
    {
        User::find($req->id)->delete();
        return redirect('/');
    }
    
    public function updateTiming(Request $request, $timingId)
{
    $user = Auth::guard('user')->user();

    if ($user) {
        $timing = test_timing::find($timingId);
        
        // Update the timing record
        $timing->update([
            'user_id' => $user->id,
        ]);

        return redirect('/');
        // return response()->json(['success' => true]);
    }
    return redirect('/');
    // return response()->json(['success' => false]);
}

    public function booked_records(){
        $user = Auth::guard('user')->user();
        if ($user) {
            // $tests = test_timing::with('hospital')->find($user->id);
            $tests = test_timing::with('hospital')->where('user_id', $user->id)->get();
            
            
    
            return view('u_booked_records' , compact('tests'));
            // return response()->json(['success' => true]);
        }
        return redirect('/');
    }
    public function delete_timing($timingId){
        $timing = test_timing::find($timingId);
        
        // Update the timing record
        $timing->update([
            'user_id' => null,
        ]); 
        return redirect('/booked_records');
    }
    public function myreports(){
        $user_id = Auth::guard('user')->user()->id;
        // dd($user_id);
        $testReports = Test_report::with('user', 'hospital')->where('user_id',$user_id)->get();
        // dd($testReports);
        return view('test_reports', compact('testReports'));
    }
    public function generatePDF($id)
    {
        // $user_id = Auth::guard('user')->user()->id;
        // Fetch the test report data from the database
        // $testReports = Test_report::all(); // Assuming you want to fetch all test reports
        $testReports = Test_report::with('user', 'hospital')->where('id',$id)->get();

        // Load the view with the data
        $pdf = PDF::loadView('pdf.u_report', compact('testReports'));

        // To save the PDF to a specific directory within the storage/app/ directory:
        $pdfPath = public_path('pdf/u_report.pdf');

        // Save the PDF to the public folder
        Storage::put('pdf/u_report.pdf', $pdf->output());

        // To return the PDF as a response:
        // return $pdf->stream('u_report.pdf');
        return $pdf->stream('u_report.pdf', ['Content-Type' => 'application/pdf']);

    }
}
