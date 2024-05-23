@extends ('layout.master')

@section ('main_content')
    <div class="list-products d-flex flex-warp  col-3 ">
        @foreach ($listproduct as $product)
            <div class="product-item">
                <img src=" {{ $product -> Image }}" alt="{{ $product -> ProductName }}" class="w-full">
                <div class="product-info">
                    <h2 class="text-lg font-bold"> {{ $product -> ProductName }}</h2>
                    <p class="text-sm">{{ $product['Price']}}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
