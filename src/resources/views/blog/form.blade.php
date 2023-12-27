<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @method($post->id ? 'PATCH' : 'POST')

    <div class="form-group">
        <label>Image</label>
        <input type="file" class="form-control" name="image" />
        @error('image')
            {{ $message }}
        @enderror
    </div>

    <div class="form-group">
        <label>Titre</label>
        <input type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}" />
        @error('title')
            {{ $message }}
        @enderror
    </div>

    <div class="form-group">
        <label>content</label>
        <textarea name="content" class="form-control" rows="10" cols="50">{{ old('content', $post->content) }}</textarea>
        @error('content')
            {{ $message }}
        @enderror
    </div>

    <div class="form-group">
        <label>slug</label>

        <input type="text" class="form-control" name="slug" value="{{ old('title', $post->slug) }}" />

        @error('slug')
            {{ $message }}
        @enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Liste des categories</label>

        <select class="form-control" id="category" name="category_id">
          <option value="">Sélectionner une catégorie</option>
            @foreach ($categories as $categorie)
                <option @selected(old('category_id',$post->category_id) == $categorie->id) value="{{ $categorie->id }}">{{ $categorie->name }}</option>
           @endforeach
        </select>
        @error('category_id')
            {{ $message }}
        @enderror
    </div>

    <div class="form-group">
        @php
            $tagsIds = $post->tags()->pluck('id');
        @endphp
        <label for="exampleFormControlSelect1">Liste des Tags</label>

        <select class="form-control" id="tag" name="tags[]" multiple>

            @foreach ($tags as $tag)
                <option @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}">{{ $tag->name }}</option>
           @endforeach
        </select>
        @error('tag')
            {{ $message }}
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            @if ($post->id)
                Modifier
            @else
                Create
            @endif
        </button>
    </div>

</form>
