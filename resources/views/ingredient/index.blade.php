@extends('layouts.main')

@section('pageTitle','Benutzer')

@section('content')

 <h1>Zutaten</h1>

 @if( session('success') )
 <div class="alert alert-success">{{ session('success') }}</div>
 @endif

<table class="table table-hover table-settings">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Kategorie</th>
      <th class="text-center">Energie</th>
      <th class="text-center">Protein</th>
      <th class="text-center">Kohlenhydrate</th>
      <th class="text-center">Fett</th>
      <th class="text-center">Vegan</th>
      <th class="text-center">Vegetarisch</th>
      <th class="text-center">Glutenfrei</th>
    </tr>
  </thead>
  @foreach ($ingredients as $ingredient)
    <tr>
      <td scope="row">{{$ingredient->id}}</td>
      <td>{{$ingredient->title}}</td> 
      <td>{{$ingredient->category->title}}</td>
      <td class="text-center">{{$ingredient->energy}}kcal</td>
      <td class="text-center">{{$ingredient->protein}}g</td>
      <td class="text-center">{{$ingredient->carbohydrate}}g</td>
      <td class="text-center">{{$ingredient->fat}}g</td>
      <td class="text-center">@if ($ingredient->vgn) <i class="fa-solid fa-check"> @endif</td>
      <td class="text-center">@if ($ingredient->veg) <i class="fa-solid fa-check"> @endif</td>
      <td class="text-center">@if ($ingredient->gf) <i class="fa-solid fa-check"> @endif</td>
      @can('is_admin')
      <td><a href="{{route('ingredient.edit',$ingredient->id)}}" class="btn btn-outline-secondary">Bearbeiten</a></td>
      <td>
        <form action="{{route('ingredient.destroy',$ingredient->id)}}" method="POST" class="delete" data-title="{{$ingredient->email}}" data-body="Wollen Sie die Zutat <strong>{{$ingredient->title}}</strong> löschen?" data-error="Benutzer nicht gefunden!">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Löschen</button>
        </form>
      </td>
      @endcan
    </tr>
  @endforeach
</table>

<div class="button"><a href="{{route('ingredient.create')}}" class="btn btn-outline-secondary">Zutat hinzufügen</a></div>


@endsection