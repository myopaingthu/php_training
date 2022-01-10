<!DOCTYPE html>
<html lang="en">

<head>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>@yield('title') | Assignment 1</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/library/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/common.js') }}"></script>

</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">Student List</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{ route('api#showListView') }}">
                {{ __('API Student List') }}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('showEailForm') ? 'active' : '' }}" aria-current="page" 
                href="{{ route('showEailForm') }}">
                {{ __('Send Email') }}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('students.create') ? 'active' : '' }}" aria-current="page" 
                href="{{ route('students.create') }}">
                {{ __('Create Student') }}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Display Alert Messages -->
    @include('common.alert')
    <!-- Display Validation Errors -->
    @include('common.errors')
  </div><!-- /.container -->

  @yield('content')
</body>

</html>