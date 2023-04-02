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
            <div id="cart" class="preview-container side-text" data-user-id="{{auth()->user()->id}}">
                @foreach($cart as $cartItem)
                    <div class="cart-item">
                        <div class="item-qty"> {{$cartItem->item->name . " @Rp." . $cartItem->item->price . " each"}}</div>
                        <div class="cart-row">
                            <form method="POST" id="update-cart-{{$cartItem->id}}" action="/carts/update/{{$cartItem->id}}">
                                @csrf
                                @method('PUT')
                                <input id="amount-{{$cartItem->id}}" class="cart-preview" name="amount" min="1" value="{{$cartItem->amount}}" type="number" data-cart-item-id="{{$cartItem->id}}">
                            </form>
                            <form method="POST" id="delete-cart-{{$cartItem->id}}" action="/carts/delete/{{$cartItem->id}}">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="cart-btn"        form="update-cart-{{$cartItem->id}}">Change</button>
                            <button class="cart-btn delete" form="delete-cart-{{$cartItem->id}}">Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($errors->any())
                <div class="error">
                    <p class="side-text">Errors</p>
                    @foreach ($errors->all() as $error)
                        <p class="error-msg">&#9888; {{ $error }}</p>
                    @endforeach
                </div>
            @endif
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
                        <form method="POST" id="add-to-cart" action="/carts/{{auth()->user()->id}}/{{$item->id}}">
                            @csrf
                            <input type="number" name="user_id" value="{{auth()->user()->id}}" style="display: none;">
                            <input type="number" name="item_id" value="{{$item->id}}" style="display: none;">
                            <button>Add to Cart</button>
                            <div class="form-item">
                                <label for="amount">Amount</label>
                                <input id="amount" value="1" type="number" name="amount" id="amount" min="1">
                            </div>
                        </form>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

{{-- @section('script')
<script>
    // Auto update database when cart change
    // 500 (Internal Server Error)
    $('input[id^="amount-"]').on('input', function() {
      var amount = $(this).val();
      var cartItemId = $(this).data('cart-item-id');
      var userId = $('#cart').data('user-id');
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        url: '/carts/update/' + cartItemId,
        method: 'PUT',
        data: { 
            _token: csrf_token,
            amount: amount 
        },
        success: function(response) {
          // handle successful response
        },
        error: function(xhr, status, error) {
          // handle error
        }
      });
    });
</script>
@endsection --}}