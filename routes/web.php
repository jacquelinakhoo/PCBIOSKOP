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

// Admin Movies
Route::get('/admin/movies', [CinemaController::class, 'adminMovies']);
Route::get('/admin/movies/add', [CinemaController::class, 'addMovie']);
Route::post('/admin/movies/add', [CinemaController::class, 'processAddMovie']);
Route::get('/admin/movies/edit/{id}', [CinemaController::class, 'editMovie']);
Route::post('/admin/movies/edit/{id}', [CinemaController::class, 'processEditMovie']);
Route::get('/admin/movies/delete/{id}', [CinemaController::class, 'deleteMovie']);