@extends('layouts.authenticate')

@section('title') Login @endsection

@section('main')
    <div class="modal">
        <form action="/authenticate" method="POST">
            @csrf
            <p class="title">Log In</p>
            
            <div class="logo">
                <img class="logo" src="{{asset('images/open-box.png')}}" alt="">
            </div>

            <div class="form-field">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input type="text" placeholder="Type here..." name="email" id="email" class="input">
                </div>
                @error('email')
                <p class="error">&#9888; {{$message}}</p>
                @enderror
            </div>

            <div class="form-field">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" placeholder="Type here..." name="password" id="password" class="input">
                </div>
                @error('password')
                <p class="error">&#9888; {{$message}}</p>
                @enderror
            </div>
            <button type="submit"> Sign In </button>
            <p class="tiny">Don't have an account? <a href="/register">Register</a></p>
        </form>
    </div>
@endsection