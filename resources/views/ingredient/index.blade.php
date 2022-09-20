@extends('layouts.main')

@section('pageTitle','Zutaten')

@section('content')

<h1>Zutaten</h1>

<p>Hier befindet sich dann ein Text der kurz erklärt, was in dieser Ansicht gemacht werden kann.</p>

@if( session('success') )
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if( session('error') )
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

User_ID: {{auth()->user()->id}} {{-- TODO: Info nur für Dev -> später rausnehmen --}}

{{-- TODO: Filter hinzufügen --}}

<table class="table table-hover table-settings">
  <thead>
    <tr>
      <th>@sortablelink('title','Name')</th>
      <th>@sortablelink('category_id','Kategorie',['category' => 'title'])</th> {{-- FIXME: alphabetische Sortierung, nicht nach ID --}}
      <th class="text-center">@sortablelink('energy','Energie')</th>
      <th class="text-center">@sortablelink('protein','Proteine')</th>
      <th class="text-center">@sortablelink('carbohydrate','Kohlenhydrate')</th>
      <th class="text-center">@sortablelink('fat','Fette')</th>
      <th class="text-center">@sortablelink('vgn','Vegan')</th>
      <th class="text-center">@sortablelink('veg','Vegetarisch')</th>
      <th class="text-center">@sortablelink('gf','Glutenfrei')</th>
    </tr>
  </thead>
  @foreach ($ingredients as $ingredient)
  <tr @if (auth()->user()->id == $ingredient->user_id) class="table-warning"  @endif
      @if (lockedIngredients($ingredient,$ingredient->id,auth()->user()->id)) class="table-light" @endif
      id="{{$ingredient->id}}">
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
        @method('delete')
        @csrf
        @if ($ingredient->count == 1)
          <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Es muss mindestens eine Zutat in der Kategorie '{{$ingredient->category->title}}' vorhanden sein!">
        @endif
        <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" @if ($ingredient->count == 1) disabled @endif>Löschen</button>
      </form>
    </td>
    @endif
    @if ((!auth()->user()->is_admin) && (!$ingredient->user_id))
    <td colspan="2">
      @if(lockedIngredients($ingredient,$ingredient->id,auth()->user()->id))
      <form action="{{route('ingredient.lock',[$ingredient->id,'#'.$ingredient->id])}}" method="POST">
        @method('PUT')
        @csrf
        <button type="submit" class="btn btn-outline-danger">Entsperren</button>
      </form>
      @else
      <form action="{{route('ingredient.lock',[$ingredient->id,'#'.$ingredient->id])}}" method="POST">
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

<div class="myPagination">
{{ $ingredients->links("pagination::bootstrap-4")}}
</div>


<div class="button"><a href="{{route('ingredient.create')}}" class="btn btn-outline-secondary">Zutat hinzufügen</a></div>  

@endsection