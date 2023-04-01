@extends('layouts.authenticate')

@section('title') Add New Item @endsection

@section('main')
    <div class="modal">
        <form action="/admin/items" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="title">Add New Item</p>
            
            <div class="logo">
                <img class="logo" src="{{asset('images/open-box.png')}}" alt="">
            </div>

            <div class="form-field">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="create">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"> {{$category->name}} </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="">&#9888; {{$message}}</p>
                @enderror
            </div>

            <div class="form-field">
                <label for="name">Item Name</label>
                <div class="input-wrapper">
                    <input type="text" placeholder="Type here..." name="name" id="name" class="input">
                </div>
                @error('name')
                    <p class="error">&#9888; {{$message}}</p>
                @enderror
            </div>

            <div class="form-field">
                <label for="price">Price</label>
                <div class="input-wrapper">
                    <input type="text" placeholder="Type here..." name="price" id="price" class="input">
                </div>
                @error('price')
                    <p class="error">&#9888; {{$message}}</p>
                @enderror
            </div>

            <div class="form-field">
                <label for="stock">Stock</label>
                <div class="input-wrapper">
                    <input type="number" min="0" placeholder="Type here..." name="stock" id="stock" class="input">
                </div>
                @error('stock')
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

            <button type="submit"> Create </button>
        </form>
    </div>
@endsection