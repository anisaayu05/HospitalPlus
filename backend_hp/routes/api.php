<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\RoomController;

// Rute untuk Department
Route::get('/departments', [DepartmentController::class, 'index']); // Mengambil semua departemen
Route::post('/departments', [DepartmentController::class, 'store']); // Menyimpan departemen baru
Route::get('/departments/{id}', [DepartmentController::class, 'show']); // Mengambil departemen berdasarkan ID
Route::put('/departments/{id}', [DepartmentController::class, 'update']); // Memperbarui departemen berdasarkan ID
Route::delete('/departments/{id}', [DepartmentController::class, 'destroy']); // Menghapus departemen berdasarkan ID

// Rute untuk Category
Route::get('/categories', [CategoryController::class, 'index']); // Mengambil semua kategori
Route::post('/categories', [CategoryController::class, 'store']); // Menyimpan kategori baru
Route::get('/categories/{id}', [CategoryController::class, 'show']); // Mengambil kategori berdasarkan ID
Route::put('/categories/{id}', [CategoryController::class, 'update']); // Memperbarui kategori berdasarkan ID
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']); // Menghapus kategori berdasarkan ID

// Rute untuk Doctor
Route::get('/doctors', [DoctorController::class, 'index']); // Mengambil semua dokter
Route::post('/doctors', [DoctorController::class, 'store']); // Menyimpan dokter baru
Route::get('/doctors/{id}', [DoctorController::class, 'show']); // Mengambil dokter berdasarkan ID
Route::put('/doctors/{id}', [DoctorController::class, 'update']); // Memperbarui dokter berdasarkan ID
Route::delete('/doctors/{id}', [DoctorController::class, 'destroy']); // Menghapus dokter berdasarkan ID

// Rute untuk Patient
Route::get('/patients', [PatientController::class, 'index']); // Mengambil semua pasien
Route::post('/patients', [PatientController::class, 'store']); // Menyimpan pasien baru
Route::get('/patients/{id}', [PatientController::class, 'show']); // Mengambil pasien berdasarkan ID
Route::put('/patients/{id}', [PatientController::class, 'update']); // Memperbarui pasien berdasarkan ID
Route::delete('/patients/{id}', [PatientController::class, 'destroy']); // Menghapus pasien berdasarkan ID

// Rute untuk Appointment
Route::get('/appointments', [AppointmentController::class, 'index']); // Mengambil semua appointment
Route::post('/appointments', [AppointmentController::class, 'store']); // Menyimpan appointment baru
Route::get('/appointments/{id}', [AppointmentController::class, 'show']); // Mengambil appointment berdasarkan ID
Route::put('/appointments/{id}', [AppointmentController::class, 'update']); // Memperbarui appointment berdasarkan ID
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']); // Menghapus appointment berdasarkan ID

// Rute untuk Room
Route::get('/rooms', [RoomController::class, 'index']); // Mengambil semua room
Route::post('/rooms', [RoomController::class, 'store']); // Menyimpan room baru
Route::get('/rooms/{id}', [RoomController::class, 'show']); // Mengambil room berdasarkan ID
Route::put('/rooms/{id}', [RoomController::class, 'update']); // Memperbarui room berdasarkan ID
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']); // Menghapus room berdasarkan ID
