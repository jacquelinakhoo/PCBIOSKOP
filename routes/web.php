<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CinemaController;

// Auth Routes
Route::get('/', [CinemaController::class, 'index']);
Route::post('/login', [CinemaController::class, 'login']);
Route::get('/logout', [CinemaController::class, 'logout']);
Route::get('/register', [CinemaController::class, 'register']);
Route::post('/register', [CinemaController::class, 'processRegister']);

// Dashboard Routes
Route::get('/dashboard/admin', [CinemaController::class, 'dashboardAdmin']);
Route::get('/dashboard/staff', [CinemaController::class, 'dashboardStaff']);
Route::get('/dashboard/customer', [CinemaController::class, 'dashboardCustomer']);

// Customer/All Roles Movie View
Route::get('/movie/detail/{id}', [CinemaController::class, 'movieDetail']);

// Admin Movies
Route::get('/admin/movies', [CinemaController::class, 'adminMovies']);
Route::get('/admin/movies/add', [CinemaController::class, 'addMovie']); 
Route::post('/admin/movies/add', [CinemaController::class, 'processAddMovie']); 
Route::get('/admin/movies/edit/{id}', [CinemaController::class, 'editMovie']);
Route::post('/admin/movies/edit/{id}', [CinemaController::class, 'processEditMovie']);
Route::get('/admin/movies/delete/{id}', [CinemaController::class, 'deleteMovie']);

// Admin Studios
Route::get('/admin/studios', [CinemaController::class, 'adminStudios']);
Route::get('/admin/studios/add', [CinemaController::class, 'addStudio']);
Route::post('/admin/studios/add', [CinemaController::class, 'processAddStudio']);
Route::get('/admin/studios/edit/{id}', [CinemaController::class, 'editStudio']);
Route::post('/admin/studios/edit/{id}', [CinemaController::class, 'processEditStudio']);
Route::get('/admin/studios/delete/{id}', [CinemaController::class, 'deleteStudio']);

// Admin Schedules
Route::get('/admin/schedules', [CinemaController::class, 'adminSchedules']);
Route::get('/admin/schedules/add', [CinemaController::class, 'addSchedule']);
Route::post('/admin/schedules/add', [CinemaController::class, 'processAddSchedule']);
Route::get('/admin/schedules/edit/{id}', [CinemaController::class, 'editSchedule']);
Route::post('/admin/schedules/edit/{id}', [CinemaController::class, 'processEditSchedule']);
Route::get('/admin/schedules/delete/{id}', [CinemaController::class, 'deleteSchedule']);

// Admin Staff
Route::get('/admin/staff', [CinemaController::class, 'adminStaff']);
Route::get('/admin/staff/add', [CinemaController::class, 'addStaff']);
Route::post('/admin/staff/add', [CinemaController::class, 'processAddStaff']);
Route::get('/admin/staff/delete/{id}', [CinemaController::class, 'deleteStaff']);