@extends('layouts.app')

@section('title', 'Modificar libro')

@section('content')
    @if($errors->any())
        <div style="background-color: aquamarine">
            <p>
                Hay {{ $errors->count() }} error(es) en el formulario:
            </p>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('books.update', $book) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Título:</label>
            <input type="text" name="title" id="title" required value="{{ $book->title }}">
        </div>
        <div>
            <label for="isbn">ISBN:</label>
            <label>{{ $book->isbn }}</label>
        </div>
        <div>
            <label for="publisher">Imprenta:</label>
            <input type="text" name="publisher" id="publisher" value="{{ $book->publisher }}">
        </div>
        <div>
            <label for="isbn">Año de publicación:</label>
            <input type="number" name="publisher_year" id="publisher_year" value="{{ $book->publish_year }}">
        </div>
        <div>
            <label for="pages">Número de páginas:</label>
            <input type="text" name="pages" id="pages" value="{{ $book->pages }}">
        </div>
        <div>
            <label for="languaje">Idioma:</label>
            <select name="languaje" id="languaje">
                @php
                    $idiomas = ['Español', 'Inglés', 'Portugués', 'Francés'];
                @endphp
                @foreach ($idiomas as $idioma)
                    <option value="{{ $idioma }}">
                        {{ $book->languaje === $idioma ?  'selected' : ''}}
                        {{ $idioma }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="description">Descripción:</label>
            <textarea name="description" id="description" rows="4" cols="100">
            {{ $book->description }}
            </textarea>
        </div>
         <div>
            <label for="cover_url">Cover URL:</label>
            <input type="url" name="cover_url" id="cover_url" value="{{ $book->cover_url }}">
        </div>
        <div>
            <label for="total_copies">Copias totales:</label>
            <input type="number" name="total_copies" id="total_copies" required min="1" value="{{ $book->total_copies }}">
        </div>
        <div>
            <label for="category_id">Categoria:</label>
            <select name="category_id" id="category_id" required>
                <option value="">-- Seleccionar categoria --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $book->category_id == $category->id ? 'selected' : ''}}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Autores:</label>
            <div>
                @foreach($authors as $author)
                    <label for="">
                        <input 
                            type="checkbox" 
                            name="authors[]" 
                            id="authors"
                            value="{{ $author->id }}"
                            @checked($book->authors->contains($author->id))
                        >
                        {{ $author->full_name }}
                    </label>
                @endforeach
            </div>
        </div>
        <div>
            <a href="{{ route('books.index') }}">
                Cancelar
            </a>
            <button type="submit">
                Guardar Libro
            </button>
        </div>
    </form>
@endsection
