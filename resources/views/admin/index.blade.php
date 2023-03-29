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
                        <form method="POST" id="{{"delete-" . $item->id}}" class="delete" action="/admin/delete/{{$item->id}}" style="visibility: hidden">@csrf @method('DELETE')</form>
                        <form method="POST" id={{"update-" . $item->id}}   class="update" action="/admin/update/{{$item->id}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row-update">
                                <select name="category_id" id="category_id">
                                    @foreach($categories as $category)
                                        <option 
                                            value="{{$category->id}}"
                                            @if($item->category->id == $category->id)
                                                selected
                                            @endif>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <label id="category_id" class="category">(Category)<label>
                            </div>
                            <div class="row-update">
                                <input id="name" name="name" value="{{$item->name}}">
                                <label class="update" for="name">(Item Name)</label>
                            </div>
                            <div class="row-update">
                                <div class="container-row">
                                    <p>Rp. </p>
                                    <input id="price" name="price" value="{{$item->price}}">
                                </div>
                                <label class="update" for="name">(Price)</label>
                            </div>
                            <div class="row-update">
                                <input placeholder="{{$item->image}}" type="file" name="image" id="stock" min="1">
                                <label class="update" for="image">(Image)</label>
                            </div>
                            <div id="add-to-cart">
                                <div class="update-btn-container">
                                    <button class="form"            form={{"update-" . $item->id}} type="submit">Update</button>
                                    <button class="form btn-delete" form={{"delete-" . $item->id}} type="submit">Delete</button>
                                </div>
                                <div class="form-item">
                                    <label for="stock">Stock</label>
                                    <input value="{{$item->stock}}" type="number" name="stock" id="stock" min="1">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection