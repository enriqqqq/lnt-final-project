@extends('layouts.app')

@section('main')

@foreach($cartItems as $cartItem)
<form style="display: none" method="POST" id="delete-cart-{{$cartItem->id}}" action="/carts/delete/{{$cartItem->id}}">
    @csrf
    @method('DELETE')
</form>
@endforeach

<form method="POST" action="/checkout/{{auth()->user()->id}}" id="checkout">
    @csrf
    <div class="side-bar checkout">
        <p class="side-text">My Cart</p>
        @if(count($cartItems) == 0)
            <p style="align-self:center;"class="side-text">You've not added any item.</p>
        @endif
            <div id=checkout>
                @foreach($cartItems as $cartItem)
                <div class="item-container">
                    <div class="img-cwrapper">
                        <img src="{{asset('/images/no-image.jpg')}}" alt="" class="item-img">
                    </div>
                    <div class="item-info">
                        <p class="category">{{$cartItem->item->category->name}}</p>
                        <p class="item-name">{{$cartItem->item->name}}</p>
                        <p class="item-name">Rp. {{$cartItem->item->price}}</p>
                        <input data-item-price="{{$cartItem->item->price}}" name="amounts[{{$cartItem->id}}]"type="number" class="checkout amount" min="1" value ="{{$cartItem->amount}}">
                    </div>
                    <div class="sub-total">
                        <p class="category">Sub-Total</p>
                        <p id="sub-total-{{$cartItem->id}}" class="item-name">Rp. {{$cartItem->amount * $cartItem->item->price}}</p>
                    </div>
                    <div class="delete-col">
                        <button class="delete-cart delete" form="delete-cart-{{$cartItem->id}}">&#10006;</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="content checkout">
            <p class="title">Order Detail</p>
            <div class="form-field">
                <label for="phone_number">Phone Number</label>
                <div class="input-wrapper">
                    <input disabled type="text" value="{{auth()->user()->phone_number}}" name="phone_number" id="phone_number" class="input">
                </div>
                @error('phone_number')
                    <p>&#9888; {{$message}}</p>
                @enderror
            </div>
            <div class="form-field">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input disabled type="text" value="{{auth()->user()->email}}" name="email" id="email" class="input">
                </div>
                @error('email')
                    <p>&#9888; {{$message}}</p>
                @enderror
            </div>
            <div class="form-field">
                <label for="address">Address</label>
                <div class="input-wrapper">
                    <input type="text" placeholder="Type here..." name="address" id="address" class="input">
                </div>
                @error('address')
                    <p>&#9888; {{$message}}</p>
                @enderror
            </div>
            <div class="form-field">
                <label for="postal_code">Postal Code</label>
                <div class="input-wrapper">
                    <input type="text" placeholder="Type here..." name="postal_code" id="postal_code" class="input">
                </div>
                @error('postal_code')
                    <p>&#9888; {{$message}}</p>
                @enderror
            </div>
            <div class="total">
                <p style="font-size: 20px" class="category">Total</p>
                <p style="font-size: 20px" class="total-price">Rp. {{$total}}</p>
            </div>
            <input name="total" type="hidden" value="{{$total}}">
            <button @if(count($cartItems) == 0) disabled @endif form="checkout">Check Out</button>
        </div>
    </form> 
@endsection

@section('script')
<script>
    const amountInputs = document.querySelectorAll('.checkout.amount');
    amountInputs.forEach(input => {
        console.log(input.data);
        input.addEventListener('input', (event) => {
            // get id and price
            let id = event.target.getAttribute('name').match(/\d+/)[0];
            let price = event.target.getAttribute('data-item-price');
            
            // update subtotal
            let amount = event.target.value;
            let subtotal = price * amount;
            document.querySelector(`#sub-total-${id}`).textContent = `Rp. ${subtotal}`;
            
            // update total
            let total = 0;
            amountInputs.forEach(item => {
                total += item.value * item.getAttribute('data-item-price');
            });

            document.querySelector('.total-price').textContent = `Rp. ${total}`;
        });
    });
</script>
@endsection