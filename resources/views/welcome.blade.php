<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noodp,index,follow" />
    <meta name='revisit-after' content='1 days' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HBA HISTORY</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon/favicon.png" />
    <link rel="canonical" href="@yield('url')" />
    <meta property="og:locale" itemprop="inLanguage" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
    <meta property="og:url" content="@yield('url')" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="@yield('images')" />
    <meta property="og:site_name" content="HBA SPORT" />
    <meta name="copyright" content="BaoHo" />
    <meta name="author" content="Baoho">
    <meta name="geo.placename" content="Japan" />
    <meta name="geo.region" content="JP-OSAKA" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">HBA</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            @if (Route::has('login'))
            <ul class="navbar-nav">
                @auth
                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <li class="nav-item active"><a href="{{ url('/admin/dashboard') }}" class="nav-link active"><i class="fas fa-home">Home</i></a></li>
                @else
                <li class="nav-item active"><a href="{{ url('/user/dashboard') }}" class="nav-link active"><i class="fas fa-home">Home</i></a></li>
                @endif
                @else
                <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link active"><i class="fas fa-home">Home</i></a></li>
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                @if (Route::has('register'))
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                @endif
                @endauth
                @endif
            </ul>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</body>

</html>
