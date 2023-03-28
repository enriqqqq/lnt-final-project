@extends('layouts.app')

@section('main')
    <div class="side-bar">
        <form action="/" id="search">
            <div class="search-row">
                <div class="input-wrapper">
                    <input type="text" placeholder="Search Item..." name="search" class="search">
                </div>
                <button id="search" type="submit">
                    <img src="{{asset('/images/search.png')}}" alt="">
                </button>
            </div>
        </form>
        <p class="side-text">Category</p>
        <div class="category-container">
            @foreach ($categories as $category)
                <a href="{{'/?category=' . $category->id}}" class="category">{{$category->name}}</a>
            @endforeach
        </div>
        <form method="POST"action="/" id="add-category">
            @csrf
            <div class="search-row">
                <div class="input-wrapper">
                    <input type="text" placeholder="Add Category..." name="search" class="search">
                </div>
                <button id="search" class="add-category" type="submit">
                    <img src="{{asset('/images/plus.png')}}" alt="">
                </button>
            </div>
        </form>
    </div>
    @if(count($items) == 0)
        <p class= "noentry-wrapper">No Items Found</p>            
    @else
        <div class="content">
            @foreach($items as $item)
                <div class="card">
                    <div class="img-wrapper">
                        <img src="{{$item->image ? asset('storage/images/items/' . $item->image) : asset('images/no-image.jpg')}}" alt="">
                    </div>
                    <div class="description">
                        <form id="update" action="/admin/update/{{$item->id}}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <p class="category">{{$item->category->name}}</p>
                            </div>
                            <div class="row-update">
                                <label class="update" for="name">Item Name: </label>
                                <input id="name" name="name" value="{{$item->name}}">
                            </div>
                            <div class="row-update">
                                <label class="update" for="name">Price: </label>
                                <p>Rp. </p>
                                <input id="price" name="price" value="{{$item->price}}">
                            </div>
                            <div class="row-update">
                                <label class="update" for="image">Image</label>
                                <input placeholder="{{$item->image}}" type="file" name="image" id="stock" min="1">
                            </div>
                            <div id="add-to-cart">
                                <div class="update-btn-container">
                                    <button class="form" type="submit">Update</button>
                                    <button class="form btn-delete" type="submit">Delete</button>
                                </div>
                                <div class="form-item">
                                    <label for="amount">Stock</label>
                                    <input value="{{$item->stock}}" type="number" name="stock" id="stock" min="1">
                                </div>
                            </div>
                        </form>
                        <form action="/admin/delete/{{$item->id}}" id="delete" style="visibility: hidden">@csrf @method('DELETE')</form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection