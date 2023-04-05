@extends('layouts.app')

@section('title') {{auth()->user()->name}} @endsection

@section('main')
    <div class="container" 
        style="
            display: flex; 
            width: 100%;
            padding: 60px;
            justify-content: center;
        ">
        <div class="modal" style="align-items: center; width: 55%; gap: 20px;">
            <p class="title">Profile</p>
            <div class="container" style="display: flex; gap: 45px; align-items:center; justify-content: center;">
                <div class="img-cwrapper" style="width: 35%; height: 85%">
                    <img class="item-img" src="{{auth()->user()->image ? asset('storage/images/users/' . auth()->user()->image) : asset('images/no-image.jpg')}}" alt="">
                </div>
                <form action="{{url('/users/update/' . auth()->user()->id)}}" method="POST" enctype="multipart/form-data" id="update" style="display: flex; flex-direction: column; gap: 10px;">
                    @csrf
                    @method('PUT')

                    @if(auth()->user()->isAdmin())
                    <div class="form-field">
                        <label for="name">Admin ID</label>
                        <div class="input-wrapper">
                            <input disabled value="{{$admin->admin_id}} "type="text" placeholder="Type here..." id="admin_id" class="input">
                        </div>
                        @error('admin_id')
                            <p>&#9888; {{$message}}</p>
                        @enderror
                    </div>
                    @endif

                    <div class="form-field">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <input disabled value="{{auth()->user()->email}}" type="text" placeholder="Type here..." id="email" class="input">
                        </div>
                        @error('email')
                            <p>&#9888; {{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="name">Name</label>
                        <div class="input-wrapper">
                            <input value="{{auth()->user()->name}} "type="text" placeholder="Type here..." name="name" id="name" class="input">
                        </div>
                        @error('name')
                            <p>&#9888; {{$message}}</p>
                        @enderror
                    </div>
        
                    <div class="form-field">
                        <label for="email">Phone Number</label>
                        <div class="input-wrapper">
                            <input value="{{auth()->user()->phone_number}}" type="text" placeholder="Type here..." name="phone_number" id="phone_number" class="input">
                        </div>
                        @error('phone_number')
                            <p>&#9888; {{$message}}</p>
                        @enderror
                    </div>
        
                    <div class="form-field">
                        <label for="image">Image</label>
                        <div class="input-wrapper">
                            <input type="file" placeholder="Type here..." name="image" id="image" class="input" accept="image/*">
                        </div>
                        @error('image')
                            <p>&#9888; {{$message}}</p>
                        @enderror
                    </div>
                </form>
            </div>
            <button form="update">Update</button>
        </div>
    </div>
@endsection