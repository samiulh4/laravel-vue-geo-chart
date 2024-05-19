<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Geo Chart</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/png"/>
{{--    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />--}}
{{--    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.1/dist/flowbite.min.css" />--}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div id="app"></div>
</body>
</html>
