<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="//forum.dev:6001/socket.io/socket.io.js"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .level{display:flex;align-items:center;}
        .flex{flex:1;}
        .mr-1{margin-right:1em;}
        [v-cloak]{display:none;}
    </style>

    <!-- Scripts -->
    <script>
        window.app = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user'=>Auth::user(),
            'signedIn' => Auth::check()
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        @include('layouts.nav') 
        @yield('content')
        <flash message="{{ session('flash') }}"></flash>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
