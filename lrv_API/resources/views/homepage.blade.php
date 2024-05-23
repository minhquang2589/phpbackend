@extends ('layout.client_master')
@section ('main_content')
@if(session('success') !== null)
    <div>
        <h1>{{ session('success') }}</h1>
    </div>
@endif
    @if(count($ListProductCart) > 0)
        <div class="cart-title" >
            <strong>Total: {{ count($ListProductCart)}} items</strong>
            <br>
            <span>Total Price: {{$TotalPrice}}</span>
        </div>
    @endif
@if(!empty($ListProductCart))
    <div class="card-warp d-flex col-6">
        @foreach($ListProductCart as $value)
            <div class="card flex  " style="width: 10rem;">
                <img class="card-img-top" src=" {{ $value -> Image }}" alt="{{ $value -> ProductName }}" >
                <div class="card-body">
                <h2 class="text-lg font-bold"> {{ $value -> ProductName }}</h2>
                    <p class="text-sm"> Price: {{ $value -> Price}}</p>
                    <p class="text-sm">Quantity: {{ $cart[$value->id]['qty'] }}</p>
                    <a class="btn btn-danger" href="{{ route('removeFromCart', ['id' => $value->id]) }}">Remove</a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>Giỏ hàng trống</p>
@endif
<div class="checkout">
    <a href="\checkout">Checkout!</a>
</div>

<br><br><br>
    <div class="list-products d-flex flex-warp row ">
        @foreach ($listproduct as $product)
        <div class="product-item col-4">
        <img src="{{ asset($product->Image) }}" alt="{{ $product->ProductName }}" class="w-full">
                <div class="product-info">
                    <h2 class="text-lg font-bold"> {{ $product -> ProductName }}</h2>
                    <p class="text-sm">{{ $product['Price']}}</p>
                    <a href="\?addcart={{$product ->id}}" class="btn btn-primary mb-3">Add cart</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection



