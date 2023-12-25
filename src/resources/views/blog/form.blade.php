<form action="" method="post">
    @csrf
    @method($post->id ? 'PATCH' :'POST')
    <div>
        <input type="text" name="title" value="{{ old('title',$post->title) }}" />
        @error('title')
            {{ $message }}
        @enderror
    </div>
    <div>
        <textarea name="content" rows="10" cols="50">{{ old('content',$post->content) }}</textarea>
        @error('content')
            {{ $message }}
        @enderror
    </div>
    <div>
        <input type="text" name="slug" value="{{ old('title',$post->slug) }}" />

    @error('slug')
        {{ $message }}
    @enderror
    </div>
    <button>
        @if ($post->id)
            Modifier

            @else

            Create
        @endif

    </button>
</form>
