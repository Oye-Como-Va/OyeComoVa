<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oye cómo va</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss', 'resources/css/custom.css'])
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
        crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('img/favicon.ico') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    @yield('landing')
    @yield('general')
</body>

</html>
