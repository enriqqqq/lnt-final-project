@extends('layouts.app')

@section('title') Dashboard @endsection

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
        @auth
            <p class="side-text">Cart Preview</p>
            <div class="preview-container side-text">
                <div class="item-qty">Laptop 1X</div>
                <div class="item-qty">Laptop 1X</div>
                <div class="item-qty">Laptop 1X</div>
                <div class="item-qty">Laptop 1X</div>
            </div>
            <button id="check-out">Check Out</button>
        @endauth
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
                        <div class="row">
                            <p class="category">{{$item->category->name}}</p>
                            <p>Stock: {{$item->stock}}</p>
                        </div>
                        <p class="item-name">{{$item->name}}</p>
                        <p class="price">Rp. {{$item->price}}</p>
                        @auth
                        <form id="add-to-cart" action="">
                            <button>Add to Cart</button>
                            <div class="form-item">
                                <label for="amount">Amount</label>
                                <input value="1" type="number" name="amount" id="amount" min="1">
                            </div>
                        </form>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection