@extends('layouts.main')

@section('pageTitle','Rezepte')

@section('content')

<h1>Rezepte</h1>

<p>Hier befindet sich dann ein Text der kurz erklärt, was in dieser Ansicht gemacht werden kann.</p>

@if( session('success') )
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if( session('error') )
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

User_ID: {{auth()->user()->id}} {{-- TODO: Info nur für Dev -> später rausnehmen --}}

<table class="table table-hover table-settings">
  <thead>
    <tr>
      <th class="text-center">Salatbasis</th>
      <th class="text-center">Gemüse</th>
      <th class="text-center">Kohlenhydrate</th>
      <th class="text-center">Proteine</th>
      <th class="text-center">Fette</th>
      <th class="text-center">Früchte</th>
      <th class="text-center">Topping</th>
      <th class="text-center">Gespeichert</th>
    </tr>
  </thead>
    @foreach ($recipes as $recipe)
      <tr @if ($recipe->is_bookmarked) class="table-warning" @endif>
        @foreach ($recipe->ingredients as $ingredient)
            <td class="text-center">{{$ingredient->title}}</td>
        @endforeach
        <td class="text-center">
          @if ($recipe->is_bookmarked)
            <button type="submit" class="btn btn-outline-dark"><i class="fa-solid fa-bookmark"></i></button>
          @else
            <button type="submit" class="btn btn-outline-dark"><i class="fa-regular fa-bookmark"></i></button>
          @endif
        </td>
        <td><a href="{{route('recipe.edit',$recipe->id)}}" class="btn btn-outline-secondary">Bearbeiten</a></td>
        <td>
          <button type="submit" class="btn btn-outline-danger">Löschen</button>
        </td>
      </tr>
    @endforeach
</table>

@endsection