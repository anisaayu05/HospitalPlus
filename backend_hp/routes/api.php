<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HealthController;
use App\Http\Controllers\Api\MedicalController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\RoomController;

// Rute untuk HealthRecord
Route::get('/health-records', [HealthController::class, 'index']); // Mengambil semua Health Records
Route::post('/health-records', [HealthController::class, 'store']); // Menyimpan Health Record baru
Route::get('/health-records/{id}', [HealthController::class, 'show']); // Mengambil Health Record berdasarkan ID
Route::put('/health-records/{id}', [HealthController::class, 'update']); // Memperbarui Health Record berdasarkan ID
Route::delete('/health-records/{id}', [HealthController::class, 'destroy']); // Menghapus Health Record berdasarkan ID

// Rute untuk Medical
Route::get('/medicals', [MedicalController::class, 'index']); // Mengambil semua Medical record
Route::post('/medicals', [MedicalController::class, 'store']); // Menyimpan Medical record baru
Route::get('/medicals/{id}', [MedicalController::class, 'show']); // Mengambil Medical record berdasarkan ID
Route::put('/medicals/{id}', [MedicalController::class, 'update']); // Memperbarui Medical record berdasarkan ID
Route::delete('/medicals/{id}', [MedicalController::class, 'destroy']); // Menghapus Medical record berdasarkan ID

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
