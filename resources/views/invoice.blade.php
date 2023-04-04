@extends('layouts.app')

@section('title') {{$invoice}} @endsection

@section('main')
    <div class="container" 
        style="
            display: flex; 
            width: 100%;
            padding: 60px;
            justify-content: center;
        ">
        <div class="modal">
            <p class="title">Order Detail</p>
            <div class="cart-item">
                <p class="category">Invoice Number</p>
                <p>{{$invoice}}</p>
            </div>
            <div class="cart-item">
                <p class="category">Date</p>
                <p>{{$date}}</p>
            </div>
            <div class="cart-item">
                <p class="category">Address</p>
                <p>{{$address}}</p>
            </div>
            <div class="cart-item">
                <p class="category">Postal Code</p>
                <p>{{$postal_code}}</p>
            </div>
            <div class="cart-item">
                <div class="item-sub">
                    <p class="category">Items</p>
                    <p class="category">Sub Total</p>
                </div>
                @foreach($items as $item)
                <div class="item-sub">
                    <div style="gap: 12px; align-items:center;" class="cart-row">
                        <p>{{$item->item->name}} x{{$item->amount}}</p>
                        <span style="font-size: 12px;font-weight:700">{{$item->item->category->name}}</span>
                    </div>
                    <p>Rp. {{$item->amount * $item->item->price}}</p>
                </div>
                @endforeach
            </div>
    
            <div class="cart-item" style="margin-top: 30px;">
                <div class="item-sub">
                    <p class="category">Total</p>
                    <p class="category">Rp. {{$total}}</p>
                </div>
            </div>
            <div class="cart-item" style="margin-top: 30px;">
                <a href="/sendmail" id="checkout">Print</a>
                <div class="link" style="display:flex; align-self:center">
                    <p style="margin-top: 7px;"class="tiny">Go Back to <a href="/">Dashboard</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection