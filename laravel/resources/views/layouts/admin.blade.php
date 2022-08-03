<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link href="{{ asset('/themes/vendor/fontawesome-free-6.0.0-web/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @yield('styles')
</head>

<body id="page-top">
@if(session('message'))
            <div class="row mb-2">
                <div class="col-lg-12">
                    <div class="alert {{ session('alert-class') }}" role="alert">{{ session('message') }}</div>
                </div>
            </div>
@endif
@if($errors->count() > 0)
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="logoutform" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Logo</a>

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">List Product</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">List Brand</a>
    </li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Dropdown link
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Link 1</a>
            <a class="dropdown-item" href="#">Link 2</a>
        </div>  
    </li>

    <li class="nav-item" style="margin-left: auto">
        <a class="btn btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a>
    </li>
  </ul>
</nav>
@yield('content')

<!-- Bootstrap core JavaScript-->

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
@yield('scripts')

</body>
</html>
