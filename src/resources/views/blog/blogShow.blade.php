@extends('base')
@section('title','accueil de blog')

@section('content')

        <article>
            <h2>{{$post->title}}</h2>
            <p>
                {{$post->content}}
            </p>
        </article>

@endsection

