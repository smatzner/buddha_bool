<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pageTitle',config('app.name') )</title>
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/css/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 vstack">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Über</a>
          </li>
          <li class="nav-item ms-auto login-button">
            <div class="nav-link" aria-current="page" href="/" class="login-button"><i class="fa-solid fa-user"></i></div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="canvas-menu">
    <h5>Login</h5>
  </div>

  
    
    <div class="center-content">
      <h1 class="h1">The Buddha Bool</h1>
      <div class="wrapper-recipe">
          <h6>Dein Rezept für <input type="number" name="" id="" value="1" size="4"> Person:</h6>
          <p><strong>Salatbasis: </strong>Blattspinat</p> 
          <p><strong>Kohlenhyderate: </strong>Süßkartoffel</p> 
          <p><strong>Gemüse: </strong>Brokkoli</p> 
          <p><strong>Proteine: </strong>Hühnerbrust</p>
          <p><strong>Fette: </strong>Avocado</p>
          <p><strong>Früchte: </strong>Heidelbeeren</p>
          <p><strong>Topping: </strong>Hummus</p>
          

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

      document.querySelector('.login-button').addEventListener('click', function(){
          document.querySelector('.canvas-menu').classList.toggle('active');
      });

  </script>
  {{-- <script src="/css/jquery/jquery-3.3.1.min.js"></script> --}}
  <script src="/css/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/b9181b3591.js" crossorigin="anonymous"></script>
</body>
</html>