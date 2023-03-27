<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/authenticate.css')}}">
</head>
<body>
    <main>
        @yield('main')
    </main>
    <footer>
        <p class="footer">Footer @2023</p>
    </footer>
</body>
</html>