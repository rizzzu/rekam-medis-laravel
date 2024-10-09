<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\UserController;
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
Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/home', function () {
//         return view('admin.home');
//     });
// });

// Route::middleware(['auth', 'role:dokter'])->group(function () {
//     Route::get('/dokter/home', function () {
//         return view('dokter.home');
//     });
// });

// Route::middleware(['auth', 'role:perawat'])->group(function () {
//     Route::get('/perawat/home', function () {
//         return view('perawat.home');
//     });
// });

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/home', function () {
        return view('admin.home');
    })->name('admin.home');

    // Route::resource('/admin/users', UserController::class);
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    // Route::get('/admin/roles', [AdminController::class, 'indexRoles'])->name('admin.roles.index');
    // Route::get('/admin/doctors', [AdminController::class, 'indexDoctors'])->name('admin.doctors.index');
    // Route::get('/admin/nurses', [AdminController::class, 'indexNurses'])->name('admin.nurses.index');
    // Route::get('/admin/pharmacists', [AdminController::class, 'indexPharmacists'])->name('admin.pharmacists.index');
    // Route::get('/admin/patients', [AdminController::class, 'indexPatients'])->name('admin.patients.index');
});

// Doctor Routes
Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/doctor/medical_records', [DoctorController::class, 'indexMedicalRecords'])->name('doctor.medical_records.index');
    Route::get('/doctor/medical_records/create', [DoctorController::class, 'createMedicalRecord'])->name('doctor.medical_records.create');
    Route::post('/doctor/medical_records', [DoctorController::class, 'storeMedicalRecord'])->name('doctor.medical_records.store');
});

// Nurse Routes
Route::middleware(['auth', 'role:perawat'])->group(function () {
    Route::get('/nurse/checkups', [NurseController::class, 'indexCheckups'])->name('nurse.checkups.index');
    Route::get('/nurse/checkups/create', [NurseController::class, 'createCheckup'])->name('nurse.checkups.create');
    Route::post('/nurse/checkups', [NurseController::class, 'storeCheckup'])->name('nurse.checkups.store');
});

// Pharmacist Routes
Route::middleware(['auth', 'role:apoteker'])->group(function () {
    Route::get('/pharmacist/medications', [PharmacistController::class, 'indexMedications'])->name('pharmacist.medications.index');
    Route::get('/pharmacist/medications/create', [PharmacistController::class, 'createMedication'])->name('pharmacist.medications.create');
    Route::post('/pharmacist/medications', [PharmacistController::class, 'storeMedication'])->name('pharmacist.medications.store');
});

// tes
// Tambahkan rute lain untuk role lain jika diperlukan
