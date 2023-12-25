<?php

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
Route::prefix("/blog")->name("blog.")->controller(BlogController::class)->group(function () {

    Route::get('/', 'index')->name('index');

    Route::get("/{slug}-{post}", 'show')->where([
        'slug' => "[a-z0-9/-]+",
        'id' => "[0-9]+"
    ])->name('show');

    Route::get('/new','create')->name('create');
    Route::post('/new','store')->name('store');
    Route::get('/{post}/edit','edit')->name('edit');
    Route::patch('/{post}/edit','update');

    // route get post with slug
    /*   Route::get("/{post:slug}", 'show')->where([
            'post' => "[a-z0-9/-]+",

        ])->name('show');*/

});
