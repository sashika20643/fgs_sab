<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\student\PaymentController;
use App\http\Controllers\Admin\AdminPaymentController;
use App\http\Controllers\Admin\UserController;
use App\http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

route::get('/home','HomeController@index')->name('index')->middleware([
    'auth',

]);



Auth::routes();
Route::middleware(['auth'])->group(function () {

// -------------Admin-----------------------

    Route::middleware('isAdmin'
    )->prefix('/admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('Admin.index');
        })->name('dashboard');


    route::get('/adminpaymentview',[AdminPaymentController::class,'AdminPaymentView'])->name('AdminPaymentView');
    route::post('/filterpayment',[AdminPaymentController::class,'filterpayment'])->name('filterpayment');



    route::get('/adduser',[UserController::class,'Adduser'])->name('adduser');
    route::post('/addusertodb',[UserController::class,'Addusertodb'])->name('Controller.adduser');
    route::get('/allusers',[UserController::class,'allusers'])->name('allusers');
    route::post('/studentfilter',[UserController::class,'studentfilter'])->name('studentfilter');


    route::get('/addstudents',[UserController::class,'addstudents'])->name('addstudents');
    route::get('/AddstudentstoUser',[UserController::class,'AddstudentstoUser'])->name('AddstudentstoUser');
    route::get('/allstudents',[UserController::class,'allstudents'])->name('allstudents');
    route::get('/Studentview/{email}',[UserController::class,'Studentview'])->name('Studentview');
    route::get('/StudentPaymentView/{email}',[UserController::class,'StudentPaymentView'])->name('StudentPaymentView');
    route::get('/changePType/{email}',[UserController::class,'changePType'])->name('changePType');



    route::get('/DeleteStudent/{email}',[UserController::class,'DeleteStudent'])->name('DeleteStudent');


    route::get('/paymentapprove/{id}',[AdminPaymentController::class,'paymentapprove'])->name('admin.approve');


    //reports
    route::get('/reports',[AdminPaymentController::class,'reports'])->name('admin.report');

    Route::get('/get-fees/{course_id}', [AdminPaymentController::class,'getfees'])->name('getfees');

    });





    //............student...............
    Route::middleware([

        'isStudent'
    ])->prefix('/student')->group(function () {


        Route::get('/dashboard', function () {
            return view('student.index');
        })->name('stdashboard');


    route::get('/paymentdetail',[PaymentController::class,'paymentdetail'])->name('paymentdetail');
    route::get('/addpayment',[PaymentController::class,'addpayment'])->name('addpayment');


    route::post('/pay',[PaymentController::class,'pay'])->name('pay');


    });


});


Route::get('/', function () {
    return redirect('/login');
});
Route::get('/register', function () {
    return redirect('/login');
});

// Route::get('/home', 'HomeController@index')->name('home');
