<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('images/open-box.png')}}">
</head>
<body>
    @if(session()->has('message'))
        <div class="flash" x-data="{show:true}" x-init="setTimeout(()=> show = false, 4500)" x-show="show">
            <p>{{session('message')}}</p>
        </div>
    @endif
    <header>
        <form id="logout" action="/logout" method="POST" style="display: none;">@csrf</form>
        
        <div class="logo">
            <img src="{{asset('images/open-box.png')}}" alt="" class="logo">
            <p class="title">Website Title</p>
        </div>
        <div class="right-side">
            <div class="dropdown">
                <span>Username</span>
                <div class="dropdown-content">
                    <a href="#">Profile</a>
                    <a onclick="event.preventDefault(); document.getElementById('logout').submit();">Logout</a>
                </div>
            </div>
            <img src="{{asset('images/no-profile.png')}}" alt="" class="profile">
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