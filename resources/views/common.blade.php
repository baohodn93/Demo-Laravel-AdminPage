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
    <!-- Boostrap -->
    <link href="{{url('bootstrap-4.3.1/dist/css/bootstrap.css')}}" rel="stylesheet">
    <!-- Style -->
    <link href="{{url('/css/style.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <script type="type/javascrip"> var url = {!!url('/')!!}; </script>
</head>

<body>
    @csrf
    <div id="wrapper">
        @include('front.header')
        <div class="content">
            @yield('content')
        </div>
        @include('front.footer')
    </div>
</body>

<script src="{{url('js/jquery.js')}}"></script>
<script src="{{url('bootstrap-4.3.1/dist/js/bootstrap.min.js')}}"></script>
<script src="{{url('js/front.js')}}"></script>

</html>
