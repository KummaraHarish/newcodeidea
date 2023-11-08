<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
// return view('welcome');
//});

Route::get("/", [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'ideas/', 'as' => 'ideas.' ], function () {
  Route::get("/{idea}", [IdeaController::class, 'show'])->name('show');
  

    Route::group(['middleware' => ['auth']], function(){
         Route::post("", [IdeaController::class, 'store'])->name('create');

       Route::get("/{idea}/edit", [IdeaController::class, 'edit'])->name('edit');

       Route::put("/{idea}", [IdeaController::class, 'update'])->name('update');
    
       Route::delete("/{idea}", [IdeaController::class, 'destroy'])->name('destroy');
     Route::post("/{idea}/comments", [CommentController::class, 'store'])->name('comments.store');

    });
   
});

//Route::resource('ideas', IdeaController::class)->except(['index','create','show'])->middleware('auth');
//Route::resource('ideas', IdeaController::class)->only(['show']);
//Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth');

//Route::get("/profile", [ProfileController::class, 'profile']); 

//Route::any("/idea", [IdeaController::class, 'store'])->name('idea.create'); 

Route::resource('users', UserController::class)->only('show','edit','update')->middleware('auth');

Route::get('/terms', function () {
    return view('terms');
});
