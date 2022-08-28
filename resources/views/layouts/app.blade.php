<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" style="margin: auto; max-width: 1000px;">
        <div style="padding: 20px 0px; font-size: 15px;  display: grid; grid-template-columns:  1fr 1fr 1fr; width: 600px; margin: auto;">
            <div style="text-align: center;">
                <router-link :to="{name:'journal_list'}">Журнал вызовов</router-link>
            </div>
            <div style="text-align: center;">
                <router-link :to="{name:'users_list'}">Пользователи</router-link>
            </div>
            <div style="text-align: center;">
                <router-link :to="{name:'operators_list'}">Операторы</router-link>
            </div>
        </div>
        @yield('content')
    </div>
</body>
</html>

