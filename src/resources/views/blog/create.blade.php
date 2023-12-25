@extends('base')
@section('title', 'Cree un article')

@section('content')
    <form action="" method="post">
        @csrf
        <div>
            <input type="text" name="title" value="{{ old('title','Mon titre') }}" />
            @error('title')
                {{ $message }}
            @enderror
        </div>
        <div>
            <textarea name="content" rows="10" cols="50">{{ old('content','Vous pouvez écrire ici.') }}</textarea>
            @error('content')
                {{ $message }}
            @enderror
        </div>
        @error('slug')
            {{ $message }}
        @enderror
        <button>Enregistrer</button>
    </form>
@endsection
