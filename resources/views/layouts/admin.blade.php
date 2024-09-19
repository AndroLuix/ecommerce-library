<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- bootstrap -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
 
 
<!-- axios --> 
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- font icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jQuery CDN -->
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- sweet alert -->
   

    <!-- my style -->
    <link rel="stylesheet" href="{{asset('mystyle.css')}}">

    <!-- datatable -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <!-- Scripts -->
   {{--  @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ms-5 me-auto ">
                        <div class="d-flex flex-row  gap-4 ">
                            <li>
                                <a class="btn btn-outline-dark" href="{{ route('admin.book') }}">Libri</a>
                            </li>
                            <li>
                                <a class="btn btn-outline-dark" href="{{ route('admin.discount') }}">Sconti</a>
                            </li>
                            <li>
                                <a class="btn btn-outline-dark" href="{{ route('admin.massive') }}">Massive</a>
                            </li>

                            <li>
                                <a class="btn btn-outline-dark" href="{{ route('admin.review') }}">Recensioni</a>
                            </li>

                            <li>
                                <a class="btn btn-outline-dark" href="{{ route('admin.order') }}">Ordini</a>
                            </li>
                            <li>
                                <a class="btn btn-outline-dark" href="{{route('admin.warehouse')}}">Magazzino</a>
                            </li>
                        </div>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                           
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Admin: {{ Auth::user()->name }} <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                        
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{ route('admin.book') }}" class="dropdown-item">Lista Libri</a>
                                <a href="#" class="dropdown-item">Clienti Registrati</a>
                                <a href="#" class="dropdown-item">Ordini</a>
                        
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @include('components.message')




        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('components.footer')
</body>
<script defer src="{{asset('js/app.js')}}"></script>

</html>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


