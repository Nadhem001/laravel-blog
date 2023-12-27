<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Models\Post;
use Illuminate\Http\Request;
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
    return view('welcome');
});

Route::get('/login',[AuthController::class,'login'])->name('auth.login');
Route::post('/login',[AuthController::class,'doLogin']);
Route::delete('/logout',[AuthController::class,'logout'])->name('auth.logout');

Route::prefix("/blog")->name("blog.")->controller(BlogController::class)->group(function () {

    Route::get('/', 'index')->name('index');

    Route::get("/{slug}-{post}", 'show')->where([
        'slug' => "[a-z0-9/-]+",
        'id' => "[0-9]+"
    ])->name('show');

    Route::get('/new','create')->name('create')->middleware('auth');
    Route::post('/new','store')->name('store')->middleware('auth');
    Route::get('/{post}/edit','edit')->name('edit')->middleware('auth');
    Route::patch('/{post}/edit','update')->middleware('auth');

    // route get post with slug
    /*   Route::get("/{post:slug}", 'show')->where([
            'post' => "[a-z0-9/-]+",

        ])->name('show');*/

});
