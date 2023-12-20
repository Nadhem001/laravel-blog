<?php

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
Route::prefix("/blog")->name("blog.")->group(function(){
    Route::get('/', function () {
        return [
            "link"=>\route('blog.show',["slug"=>"nadhem-27","id"=>13])
        ];
    })->name('blog.index');
    
    Route::get("/{slug}-{id}",function(string $slug,string $id,Request $request){
        return [
            "slug" => $slug,
            "id" => $id,
            "name"=> $request->input("name","John Doe"),
    
        ];
    })->where([
        'slug' => "[a-z0-9/-]+",
        'id'=>"[0-9]+"
    ])->name('show');
});

