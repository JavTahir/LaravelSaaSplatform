<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\Main;
use App\Http\Controllers\SocialController;

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

// Route::get('/main', 'App\Http\Controllers\Main@index');

// // Route::get('/home', 'App\Http\Controllers\Main@home');
// Route::get('/contact', 'App\Http\Controllers\Main@contact');
// Route::get('/result', 'App\Http\Controllers\Main@result');
// Route::get('/students', 'App\Http\Controllers\Main@students');

// Route::get('/home', function () {
//     return view('home',['records'=>'1']);
// });


Route::get('/accounts', 'App\Http\Controllers\Main@addaccounts');

Route::get('/pages', 'App\Http\Controllers\Main@addpages');

Route::get('/pagesadded', [Main::class, 'show']);

Route::get('/login',[AuthManager::class,'login'])->name('login');

Route::post('/login',[AuthManager::class,'loginPost'])->name('login.post');

Route::get('/facebook/redirect',[SocialController::class,'facebookRedirect'])->name('facebookRedirect');

Route::get('/facebook/callback',[SocialController::class,'facebookCallback'])->name('facebookCallback');

Route::get('/signup',[AuthManager::class,'signup'])->name('signup');

Route::post('/signup',[AuthManager::class,'signupPost'])->name('signup.post');

Route::get('logout',[AuthManager::class,'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/inbox', function () {
    return view('inbox');
})->name('inbox');

Route::get('/streams', function () {
    return view('streams');
})->name('streams');

Route::get('/posts', function () {
    return view('newpost');
})->name('posts');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/users', function () {
    return view('users');
})->name('users');


Route::get('/dashboardadm', function () {
    return view('dashboard_admin');
})->name('dashboardadm');

Route::get('/viewuser', function () {
    return view('viewuser');
})->name('view');


Route::get('/payments', function () {
    return view('purchases');
})->name('payments');
