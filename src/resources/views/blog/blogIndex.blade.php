@extends('base')
@section('title','accueil de blog')

@section('content')
    <h1>Mon blog</h1>

    @foreach ($posts as $post)
        <article>
            <h2>{{$post->title}}</h2>
            <p class="small">Categorie : {{ $post->category?->name }}
            @if (!$post->tags->isEmpty())
            ,
                @foreach ($post->tags as $tag)
                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                @endforeach
            @endif
        </p>
        @if ($post->image)

            <img  alt="" src="{{ $post->imageUrl()}}" />
        @endif
            <p>
                {{$post->content}}
            </p>
            <p>
                <a href="{{ route('blog.show',['slug'=>$post->slug,'post'=>$post->id]) }}" class="btn btn-primary">Lire la suite</a>
            </p>
        </article>
    @endforeach

    {{$posts->links()}}


@endsection

