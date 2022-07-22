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
          {{-- About --}}
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/about">Über</a>
          </li>
          {{-- Login --}}
          <li class="nav-item ms-auto login-button">
            <div class="nav-link" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              <i class="fa-solid fa-user"></i>
            </div>
            {{-- Canvas Login --}}
            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                <a href="{{route('login')}}" class="nav-link">Login</a>
                <a href="{{route('register')}}" class="nav-link">Register</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- Content --}}
  @yield('content')


  {{-- <script src="/css/jquery/jquery-3.3.1.min.js"></script> --}}
  <script src="/css/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/b9181b3591.js" crossorigin="anonymous"></script>
</body>
</html>