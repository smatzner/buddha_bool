@extends('layouts.main')

@section('pageTitle','Zutaten')

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
      <th class="text-center">Proteine</th>
      <th class="text-center">Kohlenhydrate</th>
      <th class="text-center">Fette</th>
      <th class="text-center">Vegan</th>
      <th class="text-center">Vegetarisch</th>
      <th class="text-center">Glutenfrei</th>
    </tr>
  </thead>
  @can('is_user')
  @foreach ($userIngredients as $userIngredient)
  @if ($userIngredient->user_id == auth()->user()->id)
  <tr class="table-warning">
    <td scope="row">{{$userIngredient->id}}</td>
    <td>{{$userIngredient->title}}</td> 
    <td>{{$userIngredient->category->title}}</td>
    <td class="text-center">{{$userIngredient->energy}}kcal</td>
    <td class="text-center">{{$userIngredient->protein}}g</td>
    <td class="text-center">{{$userIngredient->carbohydrate}}g</td>
    <td class="text-center">{{$userIngredient->fat}}g</td>
    <td class="text-center">@if ($userIngredient->vgn) <i class="fa-solid fa-check"> @endif</td>
    <td class="text-center">@if ($userIngredient->veg) <i class="fa-solid fa-check"> @endif</td>
    <td class="text-center">@if ($userIngredient->gf) <i class="fa-solid fa-check"> @endif</td>
    <td><a href="" class="btn btn-outline-secondary">Bearbeiten</a></td>
    <td><button type="submit" class="btn btn-outline-danger">Löschen</button></td>
  </tr>   
  @endif
  @endforeach
  @endcan
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
      <form action="{{route('ingredient.destroy',$ingredient->id)}}" method="POST" class="delete" data-title="{{$ingredient->email}}" data-body="Wollen Sie die Zutat <strong>{{$ingredient->title}}</strong> löschen?" data-error="Zutat nicht gefunden!">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Löschen</button>
      </form>
    </td>
    @endcan
    @can('is_user')
    <td><a href="" class="btn btn-outline-danger">Sperren</a></td>
    <td></td>
    @endcan
  </tr>
  @endforeach
</table>

@can('is_admin')
  <div class="button"><a href="{{route('ingredient.create')}}" class="btn btn-outline-secondary">Zutat hinzufügen</a></div>  
@endcan

@can('is_user')
  <div class="button"><a href="" class="btn btn-outline-secondary">Zutat hinzufügen</a></div>
@endcan


@endsection