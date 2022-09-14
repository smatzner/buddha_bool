@extends('layouts.main')

@section('pageTitle','Rezept ändern')

@section('content')
    <h1>Rezept ändern</h1>
    <div class="button"><a href="{{route('recipe.index')}}" class="btn btn-outline-secondary">Alle Rezepte</a></div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <div id="form" class="form">
        <form action="{{'recipe.update'}}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            @for ($i = 0; $i < $categoriesCount; $i++)
            <div class="form-group mb-2">
                <label for="{{$categories[$i]->title}}_id">{{$categories[$i]->title}}</label><br>
                <select name="{{$categories[$i]->title}}" id="{{$categories[$i]->title}}_id">
                    @foreach ($ingredients as $ingredient)
                            @if ($ingredient->category_id == $categories[$i]->id)
                                <option value="{{$ingredient->id}}" @if((old('id',$recipe[$i])) == $ingredient->id) selected @endif>{{$ingredient->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endfor            
        </form>
    </div>

@endsection