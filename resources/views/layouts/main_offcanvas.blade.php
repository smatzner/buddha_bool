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
          <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            Link with href
          </a>
          <li class="nav-item ms-auto login-button">
            <div class="nav-link" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              <i class="fa-solid fa-user"></i> {{-- TODO: wandert bei collapse nicht auf die Linke Seite --}}
            </div>
            {{-- Canvas Login --}}

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

  <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
    Button with data-bs-target
  </button>
  
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div>
        Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
      </div>
      <div class="dropdown mt-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          Dropdown button
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div>
    </div>
  </div>


  <script src="/css/bootstrap/js/bootstrap.min.js"></script>
  <script src="/js/jquery-3.6.0.min.js"></script>
  <script src="/js/script.js"></script>
  <script src="/css/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/b9181b3591.js" crossorigin="anonymous"></script> {{-- TODO: herunterladen und einbinden wegen DSGVO --}}
</body>
</html>