<?php

use Illuminate\Support\Facades\Route;

/* Admin */
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CancerController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/* Patient */
use App\Http\Controllers\Patient\InquireController;

/* Doctor */

use App\Http\Controllers\Doctor\DoctorLoginController;
use App\Http\Controllers\Doctor\DoctorDashboardController;

Route::get('/', [HomeController::class, 'index'])->name('homePage');
Route::post('/addInquiry', [InquireController::class, 'addInquiry'])->name('addInquiry');
Route::group(['middleware' => ['web']], function () {

    Route::get('/doctor/login', [DoctorLoginController::class, 'loginView'])->name('doctorLogin');
    Route::post('/doctor/login', [DoctorLoginController::class, 'doctorAuth'])->name('doctorAuth');
    Route::any('/doctor/logout', [DoctorLoginController::class, 'doctorLogout'])->name('doctorLogout');

    Route::get('/admin/login', [AdminLoginController::class, 'getAdminLogin'])->name('adminLogin');
    Route::post('admin/login', [AdminLoginController::class, 'adminAuth'])->name('admin.auth');
    Route::any('adminlogout', [AdminLoginController::class, 'adminlogout'])->name('adminLogout');
    Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
       
        /* Cancer Type*/
        Route::get('/getCancerTypes', [CancerController::class, 'getCancerTypes'])->name('admin.getCancerTypes');
        Route::get('/viewAddCancerType', [CancerController::class, 'viewAddCancerType'])->name('admin.viewAddCancerType');
        Route::post('/addCancerType', [CancerController::class, 'addCancerType'])->name('admin.addCancerType');
        Route::get('/viewEditCancerType/{id}', [CancerController::class, 'viewEditCancerType'])->name('admin.viewEditCancerType');
        Route::post('/editCancerType', [CancerController::class, 'editCancerType'])->name('admin.editCancerType');
        Route::post('/changeStatus', [CancerController::class, 'changeStatus'])->name('admin.changeStatus');
        Route::post('/deleteCancerType', [CancerController::class, 'deleteCancerType'])->name('admin.deleteCancerType');

        /* Doctor Routes */
        Route::get('/getDoctors', [DoctorController::class, 'getDoctors'])->name('admin.getDoctors');
        Route::get('/viewAddDoctor', [DoctorController::class, 'viewAddDoctor'])->name('admin.viewAddDoctor');
        Route::post('/addDoctor', [DoctorController::class, 'addDoctor'])->name('admin.addDoctor');
        Route::get('/viewEditDoctor/{id}', [DoctorController::class, 'viewEditDoctor'])->name('admin.viewEditDoctor');
        Route::post('/editDoctor', [DoctorController::class, 'editDoctor'])->name('admin.editDoctor');
        Route::post('/changeDoctorStatus', [DoctorController::class, 'changeDoctorStatus'])->name('admin.changeDoctorStatus');
        Route::post('/deleteDoctor', [DoctorController::class, 'deleteDoctor'])->name('admin.deleteDoctor');
        Route::post('/changeDoctorPassword', [DoctorController::class, 'changeDoctorPassword'])->name('admin.changeDoctorPassword');

    });
    
    Route::group(['middleware' => ['doctor'],'prefix' => 'doctor'], function () {
        Route::get('/dashboard', [DoctorDashboardController::class, 'dashboard'])->name('doctor.dashboard');
        Route::get('/view-inquery/{id}', [DoctorDashboardController::class, 'getDetailInquiryById'])->name('doctor.getDetailInquiryById');
        Route::post('/addPlan', [DoctorDashboardController::class, 'addPlan'])->name('doctor.addPlan');
        Route::get('/addPlan/{id}', [DoctorDashboardController::class, 'printPlan'])->name('doctor.printPlan');
    });

  
});
