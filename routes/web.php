<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\student\PaymentController;
use App\http\Controllers\Admin\AdminPaymentController;
use App\http\Controllers\Admin\ReportController;

use App\http\Controllers\Admin\UserController;
use App\http\Controllers\Admin\SubjectController;
use App\http\Controllers\Admin\ResultController;
use App\http\Controllers\student\ResultController as StudentResultController;


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
    Route::prefix('reports')->group(function () {
    route::get('/',[ReportController::class,'reports'])->name('admin.report');

    Route::get('/get-fees/{course_id}', [ReportController::class,'getfees'])->name('getfees');

    Route::get('/generate', [ReportController::class,'generate'])->name('report.generate');
    Route::post('/sendmail', [ReportController::class,'sendmail'])->name('report.sendmail');
    // Route::get('/export', [ReportController::class,'users'])->name('report.export');
    Route::get('/export', [ReportController::class, 'export'])->name('report.export');
    });


    //Subject.....
    Route::prefix('subject')->group(function () {
        route::get('/',[SubjectController::class,'Addsubjectview'])->name('admin.subject');
        route::post('/store',[SubjectController::class,'storeSubject'])->name('admin.store');
        Route::get('/all', [SubjectController::class,'index'])->name('admin.subject.index');
        Route::delete('/subjects/{subject}', [SubjectController::class,'destroy'])->name('subjects.destroy');



        });
//result......
Route::prefix('results')->group(function () {
    Route::get('/add/{user_id}/{semester?}', [ResultController::class,'create'])->name('admin.results.create');
    Route::put('/results/{user_id}/{subject_id}', [ResultController::class, 'updateResult'])->name('admin.results.update');

});




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
    Route::get('/showresult/{semester?}', [StudentResultController::class,'show'])->name('student.results.show');


    });


});


Route::get('/', function () {
    return redirect('/login');
});
Route::get('/register', function () {
    return redirect('/login');
});

// Route::get('/home', 'HomeController@index')->name('home');
