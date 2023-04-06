@extends('layouts.app')

@section('title') History @endsection

@section('main')
    <div class="container" 
        style="
            display: flex;
            flex-direction: 0; 
            width: 100%;
            padding: 60px;
            justify-content: center;
        ">
        @if(count($orders) == 0)
        <p>You have not made any order</p>
        @else
        <div class="history-container">
            <p class="title" style="align-self: center; margin-bottom: 20px;">History</p>
            @foreach($orders as $order)
            <a href={{"/invoice" . "/" . auth()->user()->id . "/" . $order->invoice}} class="history-item">
                <div class="cart-item">
                    <p class="category">{{$order->invoice}}</p>
                    <p>{{$order->created_at->format('j F Y')}}</p>
                </div>
                <p>Rp. {{number_format($order->total, 0, ',' , '.')}}</p>
            </a>
            @endforeach
        </div>
        @endif
    </div>
@endsection