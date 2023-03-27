@extends('layouts.authenticate')

@section('title') Login @endsection

@section('main')
    <div class="modal">
        <form action="/user/store" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="title">Register</p>
            
            <div class="logo">
                <img class="logo" src="{{asset('images/open-box.png')}}" alt="">
            </div>

            <div class="form-field">
                <label for="name">Name</label>
                <div class="input-wrapper">
                    <input type="text" placeholder="Type here..." name="name" id="name" class="input">
                </div>
                @error('name')
                    <p class="error">&#9888; {{$message}}</p>
                @enderror
            </div>

            <div class="form-field">
                <label for="email">Phone Number</label>
                <div class="input-wrapper">
                    <input type="text" placeholder="Type here..." name="phone_number" id="phone_number" class="input">
                </div>
                @error('phone_number')
                    <p class="error">&#9888; {{$message}}</p>
                @enderror
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

            <div class="form-field">
                <label for="image">Image</label>
                <div class="input-wrapper">
                    <input type="file" placeholder="Type here..." name="image" id="image" class="input" accept="image/*">
                </div>
                @error('image')
                    <p class="error">&#9888; {{$message}}</p>
                @enderror
            </div>

            <button type="submit"> Register </button>
        </form>
    </div>
@endsection