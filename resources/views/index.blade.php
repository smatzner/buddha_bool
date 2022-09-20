@extends('layouts.main')

@section('pageTitle','Buddha Bool')
    
@section('content')

<div class="center-content">
    <h1>The Buddha Bool</h1>
    

    @if( session('error') )
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <form action="{{route('index.generate')}}" class="" method="POST">
        @csrf
        @if (isset($ingredients))
        <div>
            <div class="form-outline portions">
                <label class="form-label portions-label" for="typeNumber">Portionen:</label>
                <input type="number" id="typeNumber" class="form-control mx-auto portions-input" name="number" value="{{$portions}}" min="1"/>
                <button class="btn btn-sm btn-outline-secondary my-auto" name="submit" value="portions">Ok</button>
            </div>
            <p><strong>Salatbasis: </strong><span class="amount">{{$amount*0.1}}g</span> {{$ingredients[0]->title}}</p>
            <p><strong>Gemüse: </strong><span class="amount">{{$amount*0.2}}g</span> {{$ingredients[1]->title}}</p> 
            <p><strong>Kohlenhyderate: </strong><span class="amount">{{$amount*0.2}}g</span> {{$ingredients[2]->title}}</p> 
            <p><strong>Proteinquelle: </strong><span class="amount">{{$amount*0.2}}g</span> {{$ingredients[3]->title}}</p>
            <p><strong>Fette: </strong><span class="amount">{{$amount*0.15}}g</span> {{$ingredients[4]->title}}</p>
            <p><strong>Früchte: </strong><span class="amount">{{$amount*0.1}}g</span> {{$ingredients[5]->title}}</p>
            <p><strong>Topping: </strong><span class="amount">{{$amount*0.05}}g</span> {{$ingredients[6]->title}}</p>
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
        <button type="submit" id="recipeButton" name="submit" class="btn btn-secondary">Ein Rezept generieren</button>


        <div class="wrapper-settings mx-auto">
            <div class="form-check form-switch">
                <input class="form-check-input mx-auto me-2" type="checkbox" role="switch" id="veg" name="veg" @if(!empty($veg)) checked @endif>
                <label class="form-check-label mx-auto" for="veg">vegetarisch</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input mx-auto me-2" type="checkbox" role="switch" id="vgn" name="vgn" @if(!empty($vgn)) checked @endif>
                <label class="form-check-label mx-auto" for="vgn">vegan</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input mx-auto me-2" type="checkbox" role="switch" id="gf" name="gf" @if(!empty($gf)) checked @endif>
                <label class="form-check-label mx-auto" for="gf">glutenfrei</label>
            </div>
        </div>
    </form>
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