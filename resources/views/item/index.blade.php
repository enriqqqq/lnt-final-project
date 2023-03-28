<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/authenticate.css')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('images/open-box.png')}}">
</head>
<body>
    @if(session()->has('message'))
        <div class="flash" x-data="{show:true}" x-init="setTimeout(()=> show = false, 4500)" x-show="show">
            <p>{{session('message')}}</p>
        </div>
    @endif
    <header>
        <div class="logo">
            <img src="" alt="" class="logo">
            <p class="title"></p>
        </div>
        <div class="right-side">
            <img src="" alt="" class="profile">
        </div>
    </header>
    <main>
        <div class="sidebar">

        </div>
        <div class="content"></div>
    </main>
    <footer>
        <p class="footer"> www.footer.com @2023</p>
    </footer>
</body>
<script src="//unpkg.com/alpinejs" defer></script>
</html>