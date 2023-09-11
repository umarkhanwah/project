<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hospitalController;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('web')->group(function () {
    // Hospital Controller Routes
    Route::get('/hospital', [hospitalController::class, 'create'])->name('h_create');
    Route::post('/hospital', [hospitalController::class, 'store'])->name('h_store');
    Route::get('/h_login', [hospitalController::class, 'login_view'])->name('h_login_view');
    Route::post('/h_login', [hospitalController::class, 'login'])->name('h_login');
    Route::get('/h_edit/{id}', [hospitalController::class, 'edit'])->name('h_edit');
    Route::post('/h_update', [hospitalController::class, 'update'])->name('h_update');
    Route::get('/h_logout', [hospitalController::class, 'logout'])->name('h_logout');
    Route::get('/tests', [hospitalController::class, 'tests'])->name('tests');
    Route::get('tests/report/{user_id}', [hospitalController::class, 'report_view'])->name('report_view');
    Route::post('tests/report', [hospitalController::class, 'createTestReport'])->name('createreport');
    Route::get('report', [hospitalController::class, 'generatePDF'])->name('createreport');


// Damn Chat GPT
    // Route::get('/test-reports', [hospitalController::class, 'pdfs']);
    // Route::get('/test-reports/{testReportId}/pdf-image', [hospitalController::class, 'displayTestReportPdfImage'])->name('test-report-pdf-image');


    
    // User Controller Routes
    Route::get('/user', [userController::class, 'create'])->name('u_create');
    Route::post('/user', [userController::class, 'store'])->name('u_store');
    Route::get('/u_login', [userController::class, 'login_view'])->name('u_login_view');
    Route::get('/u_edit/{id}', [userController::class, 'edit'])->name('u_edit');
    Route::post('/u_update', [userController::class, 'update'])->name('u_update');
    Route::post('/u_delete', [userController::class, 'delete'])->name('u_login_view');
    Route::post('/u_login', [userController::class, 'login'])->name('u_login');
    Route::get('/u_logout', [userController::class, 'logout'])->name('u_logout');
    Route::post('/update-timing/{timingId}', [userController::class, 'updateTiming']);
    Route::get('/booked_records', [userController::class, 'booked_records']);
    Route::get('/delete_timing/{timingId}', [userController::class, 'delete_timing']);
    Route::get('/myreports', [userController::class, 'myreports'])->name('u_reports');
    Route::get('/u_report/{id}', [userController::class, 'generatePDF'])->name('u_download');

    // Admin Controller Routes
    Route::get('/admin', [adminController::class, 'create'])->name('a_create');
    Route::post('/admin', [adminController::class, 'store'])->name('a_store');
    Route::get('/', [adminController::class, 'index'])->name('index');
    Route::get('/a_login', [adminController::class, 'login_view'])->name('a_login_view');
    Route::post('/a_login', [adminController::class, 'login'])->name('a_login');

    Route::get('/a_logout', [adminController::class, 'logout'])->name('a_logout');
    // Route::post('/update-permissions', [HospitalController::class, 'updatePermissions'])->name('update.permissions');
    Route::post('/update-permissions', [HospitalController::class, 'updatePermissions'])->name('update.permissions');
    Route::get('/r_download', [adminController::class, 'reportPDF'])->name('r_download');
    Route::get('/timing_download', [adminController::class, 'timingPDF'])->name('timings_download');



    // All Roles Route
    Route::get('/allroles', function () {
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
            return view('allroles');
        }
    });
});



// Route::middleware('web')->group(function () {
//     // Your authenticated routes here
//     Route::controller(hospitalController::class)->group(function(){
 
//         Route::get('/hospital','create')->name('h_create');
//         Route::post('/hospital','store')->name('h_store');
//         Route::get('/h_login','login_view')->name('h_login_view');
//         Route::post('/h_login','login')->name('h_login');
//         Route::get('/h_logout','logout')->name('h_logout');
//     });
//     Route::controller(userController::class)->group(function(){
//         // Route::get('/u','index')->name('index');
//         Route::get('/user', 'create')->name('u_create');
//         Route::post('/user','store')->name('u_store');
//         Route::get('/u_login','login_view')->name('u_login_view');
//         Route::post('/u_login','login')->name('u_login');
//         // Route::post('/h_login','login')->name('h_login');
//         Route::get('/u_logout','logout')->name('u_logout');
//     });
//     Route::controller(adminController::class)->group(function(){
//         Route::get('/','index')->name('index');
//         Route::get('/a_login','login_view')->name('a_login_view');
//         Route::post('/a_login','login')->name('a_login');
//         Route::get('/a_logout','logout')->name('a_logout');
//     });
//     Route::get('/allroles', function () {
//             return view('allroles');
//         } );
    
//     // Route::get('/hospital',[hospitalController::class,'create']);
//     // Route::post('/hospital',[hospitalController::class,'store']);
//     // Route::get('/h_login',[hospitalController::class,'login_view']);
//     // Route::post('/h_login',[hospitalController::class,'login']);
//     // Route::get('/h_logout',[hospitalController::class,'logout']);
    
// });