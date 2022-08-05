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
  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      {{-- Navbar Collapse --}}
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 vstack">
          {{-- User Overview --}}
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/"><i class="fa-solid fa-bowl-food"></i></a>
          </li>
          {{-- About --}}
          @guest 
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/about">Über</a>
          </li>
          @endguest
          @auth
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('user.index')}}">Benutzer</a>
            </li>
          @endauth
          {{-- Login --}}
          <li class="nav-item ms-auto login-button">
            <div class="nav-link" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              <i class="fa-solid fa-user"></i> {{-- TODO: wandert bei collapse nicht auf die Linke Seite --}}
            </div>
            {{-- Canvas Login --}}
            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                @auth
                  <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">Logout</button>
                  </form>
                @else
                  @if(Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary">Login</a>
                  @endif
                  @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register</a>
                  @endif
                @endauth
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- Content --}}
  <div id="wrapper" class="container-fluid">
    @yield('content')
  </div>

  {{-- Modal --}}

  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Löschen</button>
        </div>
      </div>
    </div>
  </div>


  <script src="/css/bootstrap/js/bootstrap.min.js"></script>
  <script src="/js/jquery-3.6.0.min.js"></script>
  <script src="/js/script.js"></script>
  <script src="/css/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/b9181b3591.js" crossorigin="anonymous"></script>
</body>
</html>