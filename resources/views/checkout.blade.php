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
                        <img src="{{$cartItem->item->image ? asset('storage/images/items/' . $cartItem->item->image) : asset('/images/no-image.jpg')}}" alt="" class="item-img">
                    </div>
                    <div class="item-info">
                        <p class="category">{{$cartItem->item->category->name}}</p>
                        <p class="item-name">{{$cartItem->item->name}}</p>
                        <p class="item-name">Rp. {{number_format($cartItem->item->price, 0, ',', '.')}}</p>
                        <input data-item-price="{{$cartItem->item->price}}" name="amounts[{{$cartItem->id}}]"type="number" class="checkout amount" min="1" value ="{{$cartItem->amount}}">
                    </div>
                    <div class="sub-total">
                        <p class="category">Sub-Total</p>
                        <p id="sub-total-{{$cartItem->id}}" class="item-name">Rp. {{number_format($cartItem->amount * $cartItem->item->price, 0, ',', '.')}}</p>
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
                <p style="font-size: 20px" class="total-price">Rp. {{number_format($total, 0, ',', '.')}}</p>
            </div>
            <input name="total" type="hidden" value="{{number_format($total, 0, ',' , '.')}}">
            <div class="container" style="display: flex; flex-direction: column; align-items:center">
                <button @if(count($cartItems) == 0) disabled @endif form="checkout">Check Out</button>
                <p style="margin-top: 7px;"class="tiny">Go Back to <a href="/">Dashboard</a></p>
            </div>
            
        </div>
    </form> 
@endsection

@section('script')
<script>
    // number format configuration
    const options = { minimumFractionDigits: 0, maximumFractionDigits: 0};
    
    // select all amount inputs
    const amountInputs = document.querySelectorAll('.checkout.amount');
   
   // assign listener to update subtotal and total when amount change
    amountInputs.forEach(input => {
        console.log(input.data);
        input.addEventListener('input', (event) => {
            // get id and price
            let id = event.target.getAttribute('name').match(/\d+/)[0];
            let price = event.target.getAttribute('data-item-price');
            
            // update subtotal
            let amount = event.target.value;
            let subtotal = price * amount;
            document.querySelector(`#sub-total-${id}`).textContent = `Rp. ${subtotal.toLocaleString('en-US', options).replace(/,/g, ".")}`;
            
            // update total
            let total = 0;
            amountInputs.forEach(item => {
                total += item.value * item.getAttribute('data-item-price');
            });

            document.querySelector('.total-price').textContent = `Rp. ${total.toLocaleString('en-US', options).replace(/,/g, ".")}`;
        });
    });
</script>
@endsection