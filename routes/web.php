<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\Main;
use App\Http\Controllers\SocialController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Connections;
use App\Http\Controllers\Analytics;
use App\Http\Controllers\AdminController;



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


Route::get('/accounts', [SocialController::class,'accountsadd'])->name('addaccounts')->middleware(['auth']);

Route::get('/pages', 'App\Http\Controllers\Main@addpages');

Route::get('/pagesadded', [Main::class, 'show']);

Route::get('/login',[AuthManager::class,'login'])->name('login');

Route::post('/login',[AuthManager::class,'loginPost'])->name('login.post');

Route::get('/facebook/redirect',[SocialController::class,'facebookRedirect'])->name('facebookRedirect');

Route::get('/facebook/callback',[SocialController::class,'facebookCallback'])->name('facebookCallback');



Route::get('/twitter/redirect',[SocialController::class,'twitterRedirect'])->name('twitterRedirect');
Route::get('/twitter/callback',[SocialController::class,'twitterCallback'])->name('twitterCallback');

Route::get('/linkedin/redirect',[SocialController::class,'linkedinRedirect'])->name('linkedinRedirect');

Route::get('/linkedin/callback',[SocialController::class,'linkedinCallback'])->name('linkedinCallback');



Route::post('/linkedin/postform', [PostController::class, 'postToLinkedIn']);
Route::post('/simple-post', [PostController::class, 'simplePost']);
Route::post('/media-post', [PostController::class, 'mediaPost']);
Route::post('/post-to-linkedin', [PostController::class, 'createImageShare']);


Route::post('/twitter/postform', [TwitterController::class, 'postTweet']);

Route::post('/post-to-twitter', [TwitterController::class, 'postTweetWithMedia']);






Route::get('/twitter/post-form', [TwitterController::class, 'showTwitterForm'])->middleware(['auth']);


Route::post('/post-tweet', [TwitterController::class, 'postTweetWithMedia']);



Route::get('/signup',[AuthManager::class,'signup'])->name('signup');

Route::post('/signup',[AuthManager::class,'signupPost'])->name('signup.post');

Route::get('logout',[AuthManager::class,'logout'])->name('logout');

Route::get('/users', [AdminController::class, 'allusers'])->name('users');


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware(['auth']);

Route::get('/index', function () {
    return view('landingpage');
})->name('landingpage');


Route::get('/payment', function () {
    return view('payment');
})->name('payment')->middleware(['auth']);


Route::get('/analytics',[Analytics::class,'show'])->name('analytics-all')->middleware(['auth']);

Route::get('/analytics-7days',[Analytics::class,'analytics'])->name('analytics')->middleware(['auth']);

Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');




Route::get('/analytics-adm',[Analytics::class,'adminAnalytics'])->name('analytics-adm')->middleware(['auth']);

Route::get('/inbox', function () {
    return view('inbox');
})->name('inbox');

// Route::get('/streams', function () {
//     return view('streams');
// })->name('streams');


Route::get('/posts',[PostController::class,'shownewpost'])->name('posts')->middleware(['auth']);

// Route::get('/posts', function () {
//     return view('newpost');
// });

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// Route::get('/users', function () {
//     return view('users');
// })->name('users');


Route::get('/dashboardadm', function () {
    return view('dashboard_admin');
})->name('dashboardadm');

Route::get('viewuser/{user}',[AdminController::class,'viewProfile'])->name('ProfileView');



Route::get('/payments', function () {
    return view('purchases');
})->name('payments');


//otp


Route::post('/planpurchase',[ProfileController::class,'planLimit'])->name('confirmPurchase');
Route::post('/update-plan-fields', [ProfileController::class,'planUpdate'])->name('updatePlanFields');
Route::post('/decrement-plan-limit',[ProfileController::class,'decrementPlanLimit']);


Route::get('/verification/{id}',[AuthManager::class,'verification']);
Route::post('/verified',[AuthManager::class,'verifiedOtp'])->name('verifiedOtp');


Route::get('/resend-otp',[AuthManager::class,'resendOtp'])->name('resendOtp');



Route::post('/update-profile', 'App\Http\Controllers\ProfileController@updateProfile')->name('updateProfile');


Route::get('/profile-update',[ProfileController::class,'update'])->name('profilechange');

Route::post('/update',[ProfileController::class,'saveChanges'])->name('updatesave');

Route::get('/linkedin/connections', [Connections::class, 'getConnections']);

Route::get('/lix', [Connections::class, 'lixaccount'])->name('lixSetupPage');

Route::post('/lix-form', [Connections::class, 'lixform'])->name('submitLixForm');

Route::get('/streams',[PostController::class, 'showStreams'])->name('streams');



Route::get('/adm-login', function () {
    return view('admin_login');
})->name('admin-login');

Route::post('/login/admin', 'App\Http\Controllers\AdminController@login')->name('admin.login');



 // Add middleware to protect admin routes
 Route::middleware(['admin.auth'])->group(function () {
    Route::get('/dashboardadm', 'App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard');
    Route::get('/analytics-adm',[Analytics::class,'adminAnalytics'])->name('analytics-adm');
    Route::get('/logoutadm', 'App\Http\Controllers\AdminController@logout')->name('admin.logout');
    Route::get('/admin/analytics',[Analytics::class,'UserAnalyicsLast7Days'])->name('analytics-admin-all');
    Route::get('/admin/analytics/Month',[Analytics::class,'UserAnalyicsLastMonth'])->name('analytics-admin-month');
    Route::get('/admin/viewuser/{user}',[AdminController::class,'viewUser'])->name('adminViewUser');
    Route::post('/admin/search{',[AdminController::class,'index'])->name('users.index');
    Route::get('/search/{term}','App\Http\Controllers\AdminController@search');
    Route::get('/admin/payments',[Analytics::class,'PaymentAnalytics'])->name('payments-view');
    Route::get('/search-users', 'App\Http\Controllers\AdminController@searchUser')->name('searchUsers');



    // Add other admin routes here
});
