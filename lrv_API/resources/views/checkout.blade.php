@extends ('layout.client_master')
@section('main_content')
    <div class="container">
        <h1>Check Out!</h1>
    </div>
    <div class="row">
        <div class="col-8">
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
                                <a class="btn btn-danger justify-content-end" href="{{ route('removeFromCartout', ['id' => $value->id]) }}">Remove</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Giỏ hàng trống</p>
            @endif
        </div>
        <div class="col-4">
            <form action="{{ route('checkorder.store') }}" method="POST">
                @csrf
                <input class="form-control" type="text" name="email" placeholder="Your Email">
                <br>
                <input class="form-control" type="text" name="name" placeholder="Your Name">
                <br>
                <input class="form-control" type="text" name="address" placeholder="Your Address">
                <br>
                <input class="form-control" type="text" name="phone" placeholder="Phone Number">
                <br>
                <button class="btn btn-primary" type="submit">Order!</button>
            </form>

        </div>
    </div>
@endsection