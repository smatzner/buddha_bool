@extends('layouts.main')

@section('pageTitle','Buddha Bool')
    
@section('content')
    
<div class="center-content">
    <h1 class="h1">The Buddha Bool</h1>
    <div class="wrapper-recipe">
        <h6>Dein Rezept für <input type="number" name="" id="" value="1" size="4"> Person:</h6>
        <p><strong>Salatbasis: </strong>Blattspinat</p> 
        <p><strong>Kohlenhyderate: </strong>Süßkartoffel</p> 
        <p><strong>Gemüse: </strong>Brokkoli</p> 
        <p><strong>Proteinquelle: </strong>Hühnerbrust</p>
        <p><strong>Fette: </strong>Avocado</p>
        <p><strong>Früchte: </strong>Heidelbeeren</p>
        <p><strong>Topping: </strong>Hummus</p>
        <p>&nbsp</p>
        <p><strong>Energiegehalt: </strong>437kcal</p>
        <p><strong>Proteingehalt: </strong>56g</p>
        <p><strong>Fettgehalt: </strong>20g</p>
        <div>
            <button type="button" class="btn btn-sm btn-outline-secondary">Drucken</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Exportieren</button>
        </div>
        

    </div>
    <button id="recipeButton" class="btn btn-secondary" onclick="myClick()">Ein Rezept generieren</button>
    <br>
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

      // document.querySelector('.login-button').addEventListener('click', function(){
      //     document.querySelector('.canvas-menu').classList.toggle('active');
      // });

  </script>

@endsection