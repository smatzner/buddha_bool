@extends('layouts.main')

@section('pageTitle','Zutaten')

@section('content')

 <h1>Zutaten</h1>

 @if( session('success') )
 <div class="alert alert-success">{{ session('success') }}</div>
 @endif
 
 User_ID: {{auth()->user()->id}} {{-- TODO: Helper rausnehmen --}}

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
  <tr @if (auth()->user()->id == $ingredient->user_id) class="table-warning"  @endif
      @if (lockedIngredients($ingredient,$ingredient->id,auth()->user()->id)) class="table-light" @endif>
    <td scope="row">{{$ingredient->title}}</td> 
    <td>{{$ingredient->category->title}}</td>
    <td class="text-center">{{$ingredient->energy}}kcal</td>
    <td class="text-center">{{$ingredient->protein}}g</td>
    <td class="text-center">{{$ingredient->carbohydrate}}g</td>
    <td class="text-center">{{$ingredient->fat}}g</td>
    <td class="text-center">@if ($ingredient->vgn) <i class="fa-solid fa-check"> @endif</td>
    <td class="text-center">@if ($ingredient->veg) <i class="fa-solid fa-check"> @endif</td>
    <td class="text-center">@if ($ingredient->gf) <i class="fa-solid fa-check"> @endif</td>
    @if (($ingredient->user_id == auth()->user()->id)||(auth()->user()->is_admin == 1 && !$ingredient->user_id))
    <td><a href="{{route('ingredient.edit',$ingredient->id)}}" class="btn btn-outline-secondary">Bearbeiten</a></td>
    <td>
      <form action="{{route('ingredient.destroy',$ingredient->id)}}" method="POST" class="delete" data-title="{{$ingredient->title}}" data-body="Wollen Sie die Zutat <strong>{{$ingredient->title}}</strong> löschen?" data-error="Zutat nicht gefunden!">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Löschen</button>
      </form>
    </td>
    @endif
    @if ((!auth()->user()->is_admin) && (!$ingredient->user_id))
    <td colspan="2">
      @if(lockedIngredients($ingredient,$ingredient->id,auth()->user()->id))
      <form action="{{route('ingredient.lock',$ingredient->id)}}" method="POST">
        @method('PUT')
        @csrf
        <button type="submit" class="btn btn-outline-danger">Entsperren</button>
      </form>
      @else
      <form action="{{route('ingredient.lock',$ingredient->id)}}" method="POST">
        @method('PUT')
        @csrf
        <button type="submit" class="btn btn-outline-danger">Sperren</button>
      </form>
      @endif
    </td>
    @endif
  </tr>
  @endforeach
</table>


<div class="button"><a href="{{route('ingredient.create')}}" class="btn btn-outline-secondary">Zutat hinzufügen</a></div>  


@endsection