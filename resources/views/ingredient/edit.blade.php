@extends('layouts.main')

@section('pageTitle','Zutat ändern')

@section('content')
    <h1>Zutat {{$ingredient->title}} ändern</h1>
    <div class="button"><a href="{{route('ingredient.index')}}" class="btn btn-outline-secondary">Alle Zutaten</a></div>


    <div id="form" class="form">
        <form action="{{route('ingredient.update',$ingredient->id)}}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            {{-- Title --}}
            <div class="form-group mb-2">
                <label for="title">Name</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title',$ingredient->title)}}" required>
            </div>
            @error('title')
                <div class="invalid-feedback show-block">{{$message}}</div> {{-- Warum "display: none" bei invalid-feedback?  --}}
            @enderror
            {{-- Category --}}
            <div class="form-group mb-2">
                <label for="category_id">Kategorie</label>
                <select class="form-select" name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if((old('category_id',$ingredient->category_id)) == $category->id) selected @endif>{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <div class="invalid-feedback show-block">{{$message}}</div>
            @enderror
            {{-- Energy --}}
            <div class="form-group mb-2">
                <label for="energy">Energie</label>
                <input type="number" class="form-control" id="energy" name="energy" value="{{old('energy',$ingredient->energy)}}">
            </div>
            @error('energy')
                <div class="invalid-feedback show-block">{{$message}}</div>
            @enderror
            {{-- Protein --}}
            <div class="form-group mb-2">
                <label for="protein">Proteine</label>
                <input type="number" class="form-control" id="protein" name="protein" value="{{old('protein',$ingredient->protein)}}">
            </div>
            @error('protein')
                <div class="invalid-feedback show-block">{{$message}}</div>
            @enderror
            {{-- Carbohydrate --}}
            <div class="form-group mb-2">
                <label for="carbohydrate">Kohlenhydrate</label>
                <input type="number" class="form-control" id="carbohydrate" name="carbohydrate" value="{{old('carbohydrate',$ingredient->carbohydrate)}}">
            </div>
            @error('carbohydrate')
                <div class="invalid-feedback show-block">{{$message}}</div>
            @enderror
            {{-- Fat --}}
            <div class="form-group mb-2">
                <label for="fat">Fette</label>
                <input type="number" class="form-control" id="fat" name="fat" value="{{old('fat',$ingredient->fat)}}">
            </div>
            @error('fat')
                <div class="invalid-feedback show-block">{{$message}}</div>
            @enderror
            {{-- Vegan --}}
            <div class="form-check form-switch form-check-reverse">
                <label class="form-check-label" for="flexSwitchCheckReverse">Vegan</label>
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" @if ($ingredient->vgn) checked @endif name="vgn">
            </div>
            {{-- Vegetarian --}}
            <div class="form-check form-switch form-check-reverse">
                <label class="form-check-label" for="flexSwitchCheckReverse">Vegetarisch</label>
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" @if ($ingredient->veg) checked @endif name="veg">
            </div>
            {{-- Glutenfree --}}
            <div class="form-check form-switch form-check-reverse">
                <label class="form-check-label" for="flexSwitchCheckReverse">Glutenfrei</label>
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" @if ($ingredient->gf) checked @endif name="gf">
            </div>
            {{-- Personal ingredient --}}
            @if (auth()->user()->is_admin)
            <div class="form-check form-switch form-check-reverse">
                <label class="form-check-label" for="flexSwitchCheckReverse">persönliche Zutat</label>
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" name="personal" {{$ingredient->user_id ? 'checked' : ''}}>
            </div>              
            @endif

            <button type="submit" class="btn btn-dark">Speichern</button>
        </form>
    </div>

@endsection