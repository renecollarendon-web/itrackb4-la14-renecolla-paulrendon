<?php
use App\Http\Controllers\MovieController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
//use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'create'])->name('login'); // dapat EXACTLY "login"
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/movies/featured', [MovieController::class, 'featured'])
 ->name('movies.featured')->middleware('check.genre');

Route::get('/movies/filter/{genre?}', function($genre = null) {
 return redirect()->route('movies.index', ['genre' => $genre]);})
->name('movies.filter.old')->middleware('check.genre');

Route::resource('movies', MovieController::class)
    ->middlewareFor('index', 'check.genre')
    ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'auth');




//Route::resource('teachers', TeacherController::class)->only(['index', 'show']);
//Route::get('/teachers/featured', [TeacherController::class, 'featured'])->name('teachers.featured');

