@extends('layouts.main')

@section('pageTitle','Zutat hinzufügen')

@section('content')
    <h1>Neue Zutat hinzufügen</h1>
    <div class="button"><a href="{{route('ingredient.index')}}" class="btn btn-outline-secondary">Alle Zutaten</a></div>


    <div id="form" class="form">
        <form action="{{route('ingredient.store')}}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            {{-- Title --}}
            <div class="form-group mb-2">
                <label for="title">Name</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}" required>
            </div>
            @error('title')
                <div class="invalid-feedback show-block">{{$message}}</div> {{-- Warum "display: none" bei invalid-feedback?  --}}
            @enderror
            {{-- Category --}}
            <div class="form-group mb-2">
                <label for="category_id">Kategorie</label>
                <select class="form-select" name="category_id" id="category_id">
                    <option value="">Kategorie auswählen</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if((old('category_id')) == $category->id) selected @endif>{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <div class="invalid-feedback show-block">{{$message}}</div>
            @enderror
            {{-- Energy --}}
            <div class="form-group mb-2">
                <label for="energy">Energie</label>
                <input type="number" class="form-control" id="energy" name="energy" value="{{old('energy')}}">
            </div>
            @error('energy')
                <div class="invalid-feedback show-block">{{$message}}</div>
            @enderror
            {{-- Protein --}}
            <div class="form-group mb-2">
                <label for="protein">Proteine</label>
                <input type="number" class="form-control" id="protein" name="protein" value="{{old('protein')}}">
            </div>
            @error('protein')
                <div class="invalid-feedback show-block">{{$message}}</div>
            @enderror
            {{-- Carbohydrate --}}
            <div class="form-group mb-2">
                <label for="carbohydrate">Kohlenhydrate</label>
                <input type="number" class="form-control" id="carbohydrate" name="carbohydrate" value="{{old('carbohydrate')}}">
            </div>
            @error('carbohydrate')
                <div class="invalid-feedback show-block">{{$message}}</div>
            @enderror
            {{-- Fat --}}
            <div class="form-group mb-2">
                <label for="fat">Fette</label>
                <input type="number" class="form-control" id="fat" name="fat" value="{{old('fat')}}">
            </div>
            @error('fat')
                <div class="invalid-feedback show-block">{{$message}}</div>
            @enderror
            {{-- Vegan --}}
            <div class="form-check form-switch form-check-reverse">
                <label class="form-check-label" for="flexSwitchCheckReverse">Vegan</label>
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" name="vgn" {{old('vgn') == 1 ? 'checked' : ''}}>
            </div>
            {{-- Vegetarian --}}
            <div class="form-check form-switch form-check-reverse">
                <label class="form-check-label" for="flexSwitchCheckReverse">Vegetarisch</label>
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" name="veg" {{old('veg') == 1 ? 'checked' : ''}}>
            </div>
            {{-- Glutenfree --}}
            <div class="form-check form-switch form-check-reverse">
                <label class="form-check-label" for="flexSwitchCheckReverse">Glutenfrei</label>
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" name="gf" {{old('gf') == 1 ? 'checked' : ''}}>
            </div>

            <button type="submit" class="btn btn-dark">Speichern</button>
        </form>
    </div>

@endsection