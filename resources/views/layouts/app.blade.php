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
    <header>
        @auth
            <form id="logout" action="/logout" method="POST" style="display: none;">@csrf</form>
        @endauth

        <div class="logo">
            <a href="/"><img src="{{asset('images/open-box.png')}}" alt="" class="logo"></a>
            <p class="title">Website Title</p>
        </div>
        <div class="right-side">
            <div class="dropdown">
                <span> 
                    @auth {{auth()->user()->name}} @endauth 
                    @guest Guest @endguest
                </span>
                <div class="dropdown-content">
                    @auth
                        <a href="#">Profile</a>
                        @if(auth()->user()->isAdmin())
                            <a href="/admin/items/create">Add Item</a>
                            <a href="/">Act as User</a>
                            <a href="/admin">Admin Page</a>
                        @endif
                        <a onclick="event.preventDefault(); document.getElementById('logout').submit();">Logout</a>
                    @endauth
                    @guest
                        <a href="/login">Login</a>
                        <a href="/register">Register</a>
                    @endguest
                </div>
            </div>
            <img src= 
            @auth 
                "{{ auth()->user()->image ? asset('storage/images/users/' . auth()->user()->image) : asset('images/no-profile.png') }}"
            @endauth 
            @guest 
                "{{ asset('images/no-profile.png') }}"
            @endguest 
            alt="" class="profile">
        </div>
    </header>
    <main>
        @yield('main')
    </main>
    <footer>
        @if(session()->has('message'))
        <div class="flash" x-data="{show:true}" x-init="setTimeout(()=> show = false, 4500)" x-show="show">
            <p>{{session('message')}}</p>
        </div>
        @endif
        <p class="footer"> www.footer.com @2023</p>
    </footer>
</body>
<script src="//unpkg.com/alpinejs" defer></script>
</html>