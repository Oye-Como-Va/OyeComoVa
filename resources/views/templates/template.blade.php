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
    <link href="node_modules/toastr/toastr.css" rel="stylesheet" />

</head>

<body>
    @yield('landing')
    @yield('general')
</body>

</html>
