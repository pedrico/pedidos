<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('inspinia/js/jquery-3.1.1.min.js') }}" defer></script>
    <script src="{{ asset('inspinia/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('inspinia/js/plugins/metisMenu/jquery.metisMenu.js') }}" defer></script>
    <script src="{{ asset('inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js') }}" defer></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia/js/inspinia.js') }}" defer></script>
    <script src="{{ asset('inspinia/js/plugins/pace/pace.min.js') }}" defer></script>
  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('inspinia/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/css/picapino.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>