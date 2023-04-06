<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<style>
    * {
        font-family: 'Poppins', sans-serif, Helvetica;
        margin: 0;
        padding: 0;
        color: #272343;
    }

    .container {
        padding: 30px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .category {
        font-weight: 700;
        font-size: 16px;
    }

    .cart-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 15px;
    }

    .item-sub{
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .modal {
        display: flex;
        flex-direction: column;
        gap: 20px;
        width: 50%;
    }

    .header {
        display: flex;
        gap: 30px;
        width: 100%;
        background-color: #fffffe;
        border-bottom: 4px solid #272343;
        padding: 20px;
    }

    div.logo {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    p.title {
        font-size: 36px;
        font-weight: 700;
    }

    img.logo {
        height: 100px;
        width: auto;
    }
</style>
<body>
    <div class="header">
        <div class="logo">
            {{-- <img src="{{public_path('images/open-box.png')}}" alt="" class="logo"> --}}
            <p class="title">Website Title</p>
            <a href="{{Route('dashboard')}}" id="checkout">{{Route('dashboard')}}</a>
        </div>
    </div>
    <div class="container">
        <p class="title" style="margin-bottom: 15px;">Order Detail</p>
        <div class="modal">
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
                </div>
              @foreach($items as $item)
              <div class="item-sub">
                  <div style="gap: 12px; align-items:center;" class="cart-row">
                    <span style="font-size: 12px;font-weight:700">{{$item->item->category->name}}</span>
                      <p>{{$item->item->name}} x{{$item->amount}}</p>
                  </div>
                  <p>Rp. {{number_format($item->amount * $item->item->price, 0 , ',' , '.')}}</p>
              </div>
              @endforeach
          </div>

          <div class="cart-item" style="margin-top: 15px;">
              <div class="item-sub">
                  <p class="category">Total</p>
                  <p class="category">Rp. {{$order->total}}</p>
              </div>
          </div>
      </div>
  </div>
</body>
</html>