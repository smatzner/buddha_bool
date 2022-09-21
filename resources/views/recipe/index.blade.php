@extends('layouts.main')

@section('pageTitle','Rezepte')

@section('content')

<h1>Rezepte</h1>

<p>In der Rezepte-Übersicht können Sie zuvor generierte Rezepte speichern, bearbeiten oder löschen. Es werden stets Ihre fünf zuletzt generierten Rezepte, sowie alle mit 'Speichern' markierte Rezepte angezeigt.</p>

@if( session('success') )
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if( session('error') )
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

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
        @for ($i = 0; $i < $categoriesCount; $i++)
            <td class="text-center">{{$recipe->ingredients[$i]->title}}</td>
        @endfor
        <td class="text-center">
          <form action="{{route('recipe.bookmark',$recipe->id)}}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit" class="btn btn-outline-dark" name="is_bookmarked">
            @if ($recipe->is_bookmarked)
                <i class="fa-solid fa-bookmark"></i>
            @else
                <i class="fa-regular fa-bookmark"></i>
            @endif
            </button>
          </form>
        </td>
        <td><a href="{{route('recipe.edit',$recipe->id)}}" class="btn btn-outline-secondary">Bearbeiten</a></td>
        <td>
          <form action="{{route('recipe.destroy',$recipe->id)}}" method="POST" class="delete" data-title="Löschen" data-body="Wollen Sie das Rezept löschen?" data-error="Rezept nicht gefunden!">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Löschen</button>
          </form>
        </td>
      </tr>
    @endforeach
</table>

@endsection