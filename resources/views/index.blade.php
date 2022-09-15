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
            <p><strong>Energiegehalt: </strong>{{$energy}}kcal</p>
            <p><strong>Proteingehalt: </strong>{{$protein}}g</p>
            <p><strong>Kohlenhydratgehalt: </strong>{{$carbohydrate}}g</p>
            <p><strong>Fettgehalt: </strong>{{$fat}}g</p>
            <div>
                <button onclick="window.print()" class="btn btn-sm btn-outline-secondary">Drucken</button>
                <a href="{{route('index.pdf')}}" class="btn btn-sm btn-outline-secondary">Exportieren</a>
            </div>
        </div>
        @endif
        <button type="submit" id="recipeButton" name="form" class="btn btn-secondary">Ein Rezept generieren</button>
    </form>
</div>

<div class="wrapper-settings mx-auto">
    <div class="form-check form-switch">
        <input class="form-check-input mx-auto me-2" type="checkbox" role="switch" id="veg">
        <label class="form-check-label mx-auto" for="veg">vegetarisch</label>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input mx-auto me-2" type="checkbox" role="switch" id="vgn">
        <label class="form-check-label mx-auto" for="vgn">vegan</label>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input mx-auto me-2" type="checkbox" role="switch" id="gf">
        <label class="form-check-label mx-auto" for="gf">glutenfrei</label>
    </div>
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