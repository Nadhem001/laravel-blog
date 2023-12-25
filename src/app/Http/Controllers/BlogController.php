<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilreRequest;
use App\Http\Requests\FormPostRequest;
use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index ():View{


        return view('blog.blogIndex',[
            "posts"=>Post::paginate(1)
        ]);
    }

    public function show(string $slug, Post $post):RedirectResponse | View
    {

        if ($post->slug !== $slug) {
            return to_route('blog.show',["slug"=>$post->slug,'post'=>$post->id]);
        }

        return view('blog.blogShow',[
            'post'=>$post
        ]);
    }

    public function create(){
        $post = new Post();
        return view('blog.create',[
            'post'=>$post
        ]);
    }

    public function store(FormPostRequest $request){
        $post = Post::create($request->validated());

        return redirect()->route('blog.show',['slug'=>$post->slug,'post'=>$post->id])->with("success","L'article a bien été sauvgardé");
    }


    public function edit(Post $post){

        return view('blog.edit',[
            'post'=>$post
        ]);
    }

    public function update(FormPostRequest $request,Post $post){
        $post->update($request->validated());

        return redirect()->route('blog.show',['slug'=>$post->slug,'post'=>$post->id])->with("success","L'article a bien été edite");
    }
}
