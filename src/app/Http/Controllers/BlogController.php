<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilreRequest;
use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index (BlogFilreRequest $request):View{

        return view('blog.blogIndex',[
            "posts"=>Post::paginate(1)
        ]);
    }

    public function show(string $slug, Post $post):RedirectResponse | View
    {

        if ($post->slug !== $slug) {
            return to_route('blog.show',["slug"=>$post->slug,'id'=>$post->id]);
        }

        return view('blog.blogShow',[
            'post'=>$post
        ]);
    }
}
