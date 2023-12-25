<?php

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
Route::prefix("/blog")->name("blog.")->group(function(){
    Route::get('/', function () {
        // ****** add un post  *******
        $posts = new Post();
        $posts->title = "Mon second article";
        $posts->slug = "mon-second-article-2";
        $posts->content = "Mon contenu";
        $posts->save();

        return $posts;
        



        /** return all post */

            // return Post::all();
        
        /** return des donnee spécifique  */
       // $posts = Post::all(["id","title"]);

        //return first element
        //return $posts->first() ;

       // return Post::all(["id","title"]);
       //$posts = Post::find(1);

       //**** utlisie pagination */
            // $posts = Post::paginate(2);
            //$posts = Post::paginate(2,["id","title"]);

          /*  $posts = Post::find(1);
            $posts->title = 'Nouveau titre';
            //$posts->save();
            $posts->delete();*/


            // create post with fn create
            /*$posts = Post::create([
                "title"=>"Mon nouveau titre",
                "slug"=>"mon-nouveau-test",
                "content"=>"Mon nouveau contenu"
            ]);*/

            // update poste
            /*$posts = Post::where("id",">","1")->update([
                "title"=>"Mon nouveau titre *****",
                "slug"=>"mon-nouveau-test",
                "content"=>"Mon nouveau contenu"
            ]);*/
            //delete
            //$posts = Post::where("id",">","1")->delete();
            dump($posts);
            die();
       return $posts;

    })->name('blog.index');
    
    Route::get("/{slug}-{id}",function(string $slug,string $id,Request $request){
       return Post::findOrFail($id);
       
    })->where([
        'slug' => "[a-z0-9/-]+",
        'id'=>"[0-9]+"
    ])->name('show');
});

