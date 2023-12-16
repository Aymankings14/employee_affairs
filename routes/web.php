<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

//Route For Employee
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
Route::get('/employee/{id}/destroy', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.destroy');
// Route For Leave
Route::get('/leave', [\App\Http\Controllers\LeaveController::class, 'index'])->name('leave.index');
Route::post('/leave/store', [\App\Http\Controllers\LeaveController::class, 'store'])->name('leave.store');

// Ajax Route To get Employee details
Route::get('/get-employee-info/{id}', [\App\Http\Controllers\EmployeeController::class, 'getEmployeeInfo'])->name('getEmployeeInfo');
//Route for Approval
Route::get('/approval', [\App\Http\Controllers\ApprovalController::class, 'index'])->name('approval.index');
Route::post('/approval/store', [\App\Http\Controllers\ApprovalController::class, 'store'])->name('approval.store');
//Route For license
Route::get('/license', [\App\Http\Controllers\LicenseController::class, 'index'])->name('license.index');
Route::post('/license/post', [\App\Http\Controllers\LicenseController::class, 'store'])->name('license.store');
//Route For Medical
Route::get('/medical', [\App\Http\Controllers\MedicalController::class, 'index'])->name('medical.index');
Route::post('/medical/store', [\App\Http\Controllers\MedicalController::class, 'store'])->name('medical.store');
//get name of day for medical view
Route::get('/get-hijri-day', [\App\Http\Controllers\MedicalController::class, 'getHijriDay'])->name('getHijriDay');
//Route of interruption
Route::get('/interruption', [\App\Http\Controllers\InterruptionController::class, 'index'])->name('interruption.index');
Route::post('/interruption/store', [\App\Http\Controllers\InterruptionController::class, 'store'])->name('interruption.store');
//Route for Punishment
Route::get('/punishment', [\App\Http\Controllers\PunishmentController::class, 'index'])->name('punishment.index');
Route::post('/punishment/store', [\App\Http\Controllers\PunishmentController::class, 'store'])->name('punishment.store');
// Route For Report
Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('report.index');
Route::post('/reports/store', [\App\Http\Controllers\ReportController::class, 'store'])->name('report.store');
Route::get('migrate', function () {
    try {
        Artisan::call('migrate');
        Artisan::call('db:seed');
        return 'done';
    } catch (Exception $e) {
        return $e->getMessage();
    }

});
