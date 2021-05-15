<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS files -->

    <link href="assets/css/vendor.min.css" rel="stylesheet" />
    <link href="assets/css/app.min.css" rel="stylesheet" />


</head>

<body class="antialiased">
    <div>

        <main class="py-5">
            @yield('content')
        </main>
    </div>

    <script src="assets/js/vendor.min.js" type="0485eeef8cf3263d1a7b2548-text/javascript"></script>
    <script src="assets/js/app.min.js" type="0485eeef8cf3263d1a7b2548-text/javascript"></script>
    <script src="assets/js/demo/dashboard.demo.js" type="0485eeef8cf3263d1a7b2548-text/javascript"></script>

</body>

</html>
