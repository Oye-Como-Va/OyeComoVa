<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oye cómo va</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss', 'resources/css/custom.css', 'resources/css/main.css', 'resources/js/main.js', 'resources/css/util.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
        crossorigin="anonymous">

</head>

<body>
    @yield('landing')
    @yield('general')
    @yield('register')
</body>

</html>
