<?php

use Illuminate\Support\Facades\Route;

/* Admin */
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CancerController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\HomeController;

/* Patient */

use App\Http\Controllers\Patient\InquireController;

/* Doctor */

use App\Http\Controllers\Doctor\DoctorLoginController;
use App\Http\Controllers\Doctor\DoctorDashboardController;

Route::get('/', [HomeController::class, 'index'])->name('homePage');
Route::post('/add-inquiry', [InquireController::class, 'addInquiry'])->name('add_inquiry');
Route::group(['middleware' => ['web']], function () {

    Route::get('/doctor/login', [DoctorLoginController::class, 'loginView'])->name('doctor_login');
    Route::post('/doctor/login', [DoctorLoginController::class, 'doctorAuth'])->name('doctor_auth');
    Route::any('/doctor-logout', [DoctorLoginController::class, 'doctorLogout'])->name('doctor_logout');

    Route::get('/admin/login', [AdminLoginController::class, 'getAdminLogin'])->name('admin_login');
    Route::post('admin/login', [AdminLoginController::class, 'adminAuth'])->name('admin_auth');
    Route::any('admin-logout', [AdminLoginController::class, 'adminlogout'])->name('admin_logout');
    Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
        /* Cancer Type*/
        Route::resource('cancer', CancerController::class);
        Route::post('/change-status', [CancerController::class, 'changeStatus'])->name('admin.change_status');

        /* Doctor Routes */
        Route::resource('doctors', DoctorController::class);
        Route::post('/change-doctor-status', [DoctorController::class, 'changeDoctorStatus'])->name('admin.change_doctor_status');
    });

    Route::group(['middleware' => ['doctor'], 'prefix' => 'doctor'], function () {
        Route::get('/dashboard', [DoctorDashboardController::class, 'dashboard'])->name('doctor.dashboard');
        Route::get('/view-inquery/{id}', [DoctorDashboardController::class, 'getDetailInquiryById'])->name('doctor.get_detail_inquiry_by_id');
        Route::post('/add-plan', [DoctorDashboardController::class, 'addPlan'])->name('doctor.add_plan');
        Route::get('/add-plan/{id}', [DoctorDashboardController::class, 'printPlan'])->name('doctor.print_plan');
    });
});
