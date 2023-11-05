<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RutaDeLaTapa') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- importar los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Importar los estilos de Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css" crossorigin="anonymous">

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            /* padding-bottom: 100px;
            margin-bottom: 100px; */
            font-family: var(--bs-body-font-family);
            font-size: var(--bs-body-font-size);
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            color: var(--bs-body-color);
            text-align: var(--bs-body-text-align);
            background-color: var(--bs-body-bg);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            padding-top: 56px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;

        }

        .bg-color {
            background-color: #a5b6a5;
        }

        .navbar-nav li a {
            color: #fff;
            font-weight: bold;
        }


        .navbar-brand {
            font-weight: bold;
        }

        .footer {

            background-color: #a5b6a5;
            padding: 1em;
            text-align: center;
            margin-top: auto;

        }

        .copyright {
            background-color: #a5b6a5;
        }

        .btn-social {
            border-radius: 100%;
            display: inline-flex;
            width: 2.25rem;
            height: 2.25rem;
            font-size: 1.25rem;
            justify-content: center;
            align-items: center;
        }

        .btn-outline-dark {
            --bs-btn-color: #212529;
            --bs-btn-border-color: #212529;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #212529;
            --bs-btn-hover-border-color: #212529;
            --bs-btn-focus-shadow-rgb: 33, 37, 41;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #212529;
            --bs-btn-active-border-color: #212529;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #212529;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #212529;
            --bs-gradient: none;
        }

        .white-line {
            border-top: 1px solid #fff;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
    </style>

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-md navbar-light bg-color fixed-top shadow-sm">

        <div class="container">
            <a class="navbar-brand bg-color1" id="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    @role('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tapa.index') }}">{{ __('Tapas') }}</a>
                        </li>



                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bar.index') }}">{{ __('Bares') }}</a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bar_tapa.index') }}">{{ __('Bar_Tapa') }}</a>

                        </li>
                    @endrole
                    @unlessrole('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('voto.index') }}">{{ __('Votar') }}</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('voto.totalVotos') }}">{{ __('Recuento') }}</a>

                        </li>
                    @endunless

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
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
<footer class="footer text-center ">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 text-black" style="margin-top: 1rem;">
                <h4>RutaDeLaTapa</h4>
                <hr class="white-line" style="border: 2px solid #fff;">

            </div>
        </div>
    </div>
    <div class="copyright py-1 text-center text-black">
        <div class="container">
            <small>2023 &copy; Laura Martínez Hiraldo </small>
            <p>Vota tu tapa favorita</p>
        </div>
        <a class="btn btn-outline-dark btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f fa-xs"></i></a>
        <a class="btn btn-outline-dark btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter fa-xs"></i></a>
        <a class="btn btn-outline-dark btn-social mx-1" href="#!"><i
                class="fab fa-fw fa-linkedin-in fa-xs"></i></a>
        <a class="btn btn-outline-dark btn-social mx-1" href="#!"><i
                class="fab fa-fw fa-dribbble fa-xs"></i></a>
    </div>
</footer>



</html>
