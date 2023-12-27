<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilreRequest;
use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(): View
    {


        return view('blog.blogIndex', [
            "posts" => Post::with('tags', 'category')->paginate(5)
        ]);
    }

    public function show(string $slug, Post $post): RedirectResponse | View
    {

        if ($post->slug !== $slug) {
            return to_route('blog.show', ["slug" => $post->slug, 'post' => $post->id]);
        }

        return view('blog.blogShow', [
            'post' => $post
        ]);
    }

    public function create()
    {
        $post = new Post();
        return view('blog.create', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get()
        ]);
    }

    public function store(FormPostRequest $request)
    {
        $post = Post::create($request->validated());
        $post->tags()->sync($request->validated('tags'));

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with("success", "L'article a bien été sauvgardé");
    }


    public function edit(Post $post)
    {

        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get()
        ]);
    }

    public function update(FormPostRequest $request, Post $post)
    {

        $data = $request->validated();
        /** @var UploadedFile |null $image */
        $image = $request->validated('image');
        
        if($image  != null && !$image->getError()){
            $imagePath = $image->store('blog', 'public');
            $data['image'] = $imagePath;
        }

        $post->update($data);
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with("success", "L'article a bien été edite");
    }
}
