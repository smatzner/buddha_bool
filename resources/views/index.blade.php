@extends('layouts.main')

@section('pageTitle','Buddha Bool')
    
@section('content')

<div class="center-content">
    <h1 class="h1">The Buddha Bool</h1>

    @if( session('error') )
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <form action="{{route('index.generate')}}" class="" method="POST">
        @csrf
        @if (isset($ingredients))
        <div>             
            <p><strong>Salatbasis: </strong>{{$ingredients[0]->title}}</p> 
            <p><strong>Gemüse: </strong>{{$ingredients[1]->title}}</p> 
            <p><strong>Kohlenhyderate: </strong>{{$ingredients[2]->title}}</p> 
            <p><strong>Proteinquelle: </strong>{{$ingredients[3]->title}}</p>
            <p><strong>Fette: </strong>{{$ingredients[4]->title}}</p>
            <p><strong>Früchte: </strong>{{$ingredients[5]->title}}</p>
            <p><strong>Topping: </strong>{{$ingredients[6]->title}}</p>
            <p>&nbsp</p>
            <p><strong>Energiegehalt: </strong>437kcal</p>
            <p><strong>Proteingehalt: </strong>56g</p>
            <p><strong>Fettgehalt: </strong>20g</p>
            <div>
                <button type="button" class="btn btn-sm btn-outline-secondary">Drucken</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Exportieren</button>
            </div>
        </div>
        @endif
        <button type="submit" id="recipeButton" name="form" class="btn btn-secondary">Ein Rezept generieren</button>
    </form>
</div>

<div class="wrapper-settings">
    <input type="radio" name="diet" id="vgt">
    <label for="vgt">vegetarisch</label>
    <input type="radio" name="diet" id="vgn">
    <label for="vgn">vegan</label>
    <input type="radio" name="diet" id="psc">
    <label for="psc">pescetarisch</label>
    <input type="radio" name="diet" id="gltf">
    <label for="gltf">glutenfrei</label>
</div>
<p class="center-content settings">Einstellungen</p>
</div>

  <script>
      function myClick(){
          document.querySelector('.wrapper-recipe').classList.toggle('show-grid');
      }

      document.querySelector('.settings').addEventListener('click', function(){
          document.querySelector('.wrapper-settings').classList.toggle('show-block');
      });

  </script>

@endsection