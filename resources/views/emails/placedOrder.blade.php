<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div style="dispay:flex; flex-direction:column; gap:10px; align-items:center; padding: 30px; width: 100%;">
      <h1>Thanks for your order, {{$order->user->name}} </h1>
      <p>Your order is on the way, below are your order details. We hope you'll be satisfied with your order!</p>
    </div>
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
              <p>{{ $order->invoice }}</p>
          </div>
          <div class="cart-item">
              <p class="category">Date</p>
              <p>{{ $order->created_at->format('j F Y') }}</p>
          </div>
          <div class="cart-item">
              <p class="category">Address</p>
              <p>{{ $order->address }}</p>
          </div>
          <div class="cart-item">
              <p class="category">Postal Code</p>
              <p>{{ $order->postal_code }}</p>
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
                  <p>Rp. {{number_format($item->amount * $item->item->price, 0, ',' , '.')}}</p>
              </div>
              @endforeach
          </div>

          <div class="cart-item" style="margin-top: 30px;">
              <div class="item-sub">
                  <p class="category">Total</p>
                  <p class="category">Rp. {{number_format($order->total, 0 , ',', '.')}}</p>
              </div>
          </div>
          <div class="cart-item" style="margin-top: 30px;">
              <a href="{{Route('dashboard')}}" id="checkout">Go to Website</a>
          </div>
      </div>
  </div>
</body>