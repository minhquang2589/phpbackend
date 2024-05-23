@extends('dashboard')

@section('title', 'Cart')

@section('content')
 <!-- step -->
 <div class="mt-20 lg:px-40 px-10">
      <div>
        <div class="overflow-hidden rounded-full bg-gray-200">
          <div class="h-2 w-1/2 rounded-full bg-gray-500"></div>
        </div>
        <ol class="mt-4 grid grid-cols-3 text-sm font-medium text-gray-500">
          <li class="flex items-center justify-start text-gray-600 sm:gap-1.5">
            <span class=" sm:inline">Shopping </span>
          </li>
          <li class="flex items-center justify-center text-gray-600 sm:gap-1.5">
            <span class=" sm:inline">Cart </span>
          </li>
          <li class="flex items-center justify-end sm:gap-1.5">
            <span class=" sm:inline">Check Out </span>
          </li>
        </ol>
      </div>
    </div>
<!-- end step -->
<div>
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
    <div class="mx-auto max-w-3xl">
      <div class="text-center">
        <h1 class="text-xl font-bold mt-4 lg:mt-3 text-gray-900 sm:text-3xl">Shopping Cart</h1>
      </div>
      <div class="mt-5">
        <div class="flex justify-end border-t border-gray-200"></div>
    <!--  -->
          <ul class="">
          @if($cart)
          @foreach($cart as $item)
            <li class="flex items-center gap-4 py-3">
              @if(isset($item['image']))
                <img src="{{ asset('images/' . $item['image']) }}" alt="" class="size-24 rounded object-cover">
              @else
                <span class="text-red-500 text-sm">No image available</span>
              @endif
              <div>
                @if(is_array($item) && isset($item['name']))
                  <h3 class="text-sm text-gray-600"><strong>{{$item['name']}}</strong></h3>
                @else
                  <span class="text-red-500 text-sm">No name available</span>
                @endif
                  <dl class="mt-0.5 space-y-px text-[10px] text-gray-600">
                    <div>
                        <dt class="inline">Price: {{$item['price']}}đ</dt>
                    </div>
                    <div>
                        <dt class="inline">Color:</dt>
                        <dd class="inline">{{$item['color']}}</dd>
                    </div>
                    <div>
                        <dt class="inline">Size:</dt>
                        <dd class="inline">{{$item['size']}}</dd>
                    </div>
                  </dl>
              </div>
              <div class="flex flex-1 items-center justify-end gap-2">
              <form id="updateQuantityForm{{$item['id']}}">
                  @csrf
                  <input type="hidden" name="product_id" value="{{$item['id']}}">
                  <input type="hidden" name="color" value="{{$item['color']}}">
                  <input type="hidden" name="size" value="{{$item['size']}}">
                  <label for="quantity" class="sr-only">Quantity</label>
                  <input
                      type="number"
                      min="1"
                      value="{{$item['quantity']}}"
                      data-product-id="{{$item['id']}}"
                      class="h-8 w-12 rounded border-gray-200 bg-gray-100 hover:bg-gray-300 p-0 text-center text-xs text-gray-600 [-moz-appearance:_textfield] focus:outline-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none"
                      onchange="updateQuantity(this)"
                  />
              </form>

                <form method="POST" action="{{ route('cart.remove') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                    <input type="hidden" name="size" value="{{ $item['size'] }}">
                    <input type="hidden" name="color" value="{{ $item['color'] }}">
                    <button onclick="return confirm('Are you sure you want to delete this product?')" type="submit" class="text-gray-600 transition hover:text-red-600">
                        <span class="sr-only">Remove item</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                        </svg>
                    </button>
                </form>

              </div>
            </li>
          <div class="flex justify-end border-t border-gray-300"></div>
      @endforeach
      @else
          <p class="my-2 text-[15px] italic text-gray-700">No items in cart!</p>
          <div class="flex justify-end border-t border-gray-200"></div>
      @endif
        </ul>
        <div class="justify-end flex ">
          <dl class="mt-1 italic space-y-px text-[10px] text-red-500">
            Vietnam: Recipient pays for shipping service at the time of delivery.
          </dl>
        </div>
        <div class=" mt-2 justify-end grid text-sm ">
          <div class="text-gray-700 text-sm mr-2">{{$cartQuantity}} items</div>
        </div>
        <div class="mt-8 mx-1.5	 flex justify-end  pt-8">
          <div class="w-screen max-w-lg space-y-4">
            <dl class="space-y-0.5 text-sm text-gray-700">
              <div class="flex justify-between">
                <dt>Subtotal</dt>
                <dd>{{$total}}.000đ</dd>
              </div>
              <div class="flex justify-between">
                <dt>VAT</dt>
                <dd>8%</dd>
              </div>
              <div class="flex justify-between">
                <dt>Discount</dt>
                <dd>0</dd>
              </div>
              <div class="flex justify-between !text-base font-medium">
                <dt>Total</dt>
                <dd>0</dd>
              </div>
            </dl>
            <div class="flex justify-end">
              <a
                href=""
                class="block rounded-xl bg-gray-500 px-5 py-3 text-sm text-white	 transition hover:bg-gray-700"
              >
                Checkout
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function updateQuantity(input) {
    var productId = input.getAttribute('data-product-id');
    var newQuantity = input.value;
    var color = input.form.querySelector('input[name="color"]').value;
    var size = input.form.querySelector('input[name="size"]').value;
    $.ajax({
        url: "{{ route('cart.update-quantity') }}",
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId,
            quantity: newQuantity,
            color: color,
            size: size
        },
        success: function(response) {
            // console.log('Số lượng đã được cập nhật thành công');
        },
        error: function(xhr, status, error) {
            // console.error('Lỗi khi cập nhật số lượng sản phẩm:', error);
        }
    });
}

</script>
@endsection