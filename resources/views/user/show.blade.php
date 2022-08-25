@extends('layouts.main')

@section('pageTitle','Benutzer')

@section('content')

<div >
    <label for="first_name">Vorname</label>
    <input class="form-control w-25" type="text" value="{{$user->first_name}}" id="first_name" disabled>
    <label for="last_name">Nachname</label>
    <input class="form-control w-25" type="text" value="{{$user->last_name}}" id="last_name" disabled>
    <label for="email">E-Mail Adresse</label>
    <input class="form-control w-25" type="text" value="{{$user->email}}" id="email" disabled>
</div>


<h5 class="mt-5 mb-2">Persönliche Zutaten:</h5>

<table class="table table-hover table-settings">
    <thead>
      <tr>
        <th>Name</th>
        <th>Kategorie</th>
        <th class="text-center">Energie</th>
        <th class="text-center">Proteine</th>
        <th class="text-center">Kohlenhydrate</th>
        <th class="text-center">Fette</th>
        <th class="text-center">Vegan</th>
        <th class="text-center">Vegetarisch</th>
        <th class="text-center">Glutenfrei</th>
      </tr>
    </thead>
    @foreach ($ingredients as $ingredient)
    <tr>
      <td scope="row">{{$ingredient->title}}</td> 
      <td>{{$ingredient->category->title}}</td>
      <td class="text-center">{{$ingredient->energy}}kcal</td>
      <td class="text-center">{{$ingredient->protein}}g</td>
      <td class="text-center">{{$ingredient->carbohydrate}}g</td>
      <td class="text-center">{{$ingredient->fat}}g</td>
      <td class="text-center">@if ($ingredient->vgn) <i class="fa-solid fa-check"> @endif</td>
      <td class="text-center">@if ($ingredient->veg) <i class="fa-solid fa-check"> @endif</td>
      <td class="text-center">@if ($ingredient->gf) <i class="fa-solid fa-check"> @endif</td>
    </tr>
    @endforeach
  </table>

@endsection