<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@vite('resources/css/app.css')
@vite('resources/css/header/header.css')
</head>
  @include('layout.header')
<body> 
<!--  -->
<span class="flex items-center">
    <span class="h-px flex-1 bg-slate-200"></span>
</span>
<!-- content -->
<div class="">
    @yield('content')
</div>

@if(session('isAdmin'))
    @include('sa.sasidebar')  
@endif

  @include('layout.footer')
</body>
<!-- header script -->


<script>
document.addEventListener("DOMContentLoaded", function() {
    let prevScrollPos = window.pageYOffset;
    let timer; 
    window.addEventListener("scroll", function() {
        let currentScrollPos = window.pageYOffset;
        if (prevScrollPos > currentScrollPos) {
            clearTimeout(timer);
            timer = setTimeout(function() {
                if (!document.querySelector("header").classList.contains("active")) {
                    document.querySelector("header").classList.add("active");
                }
            }, 1000); 
        } else {
            document.querySelector("header").classList.remove("active");
        }
        prevScrollPos = currentScrollPos;
    });
});
</script>
<script>

    $(document).ready(function () {
    $('[id^="addToCartBtn"]').click(function (event) {
        event.preventDefault();
        var productId = $(this).data('product-id');
        var productViewUrl = "{{ route('product.view', ['id' => ':productId']) }}";
        productViewUrl = productViewUrl.replace(':productId', productId);
        window.location.href = productViewUrl; 
    });
    $('[id^="productQuantity"]').change(function() {
        var productId = $(this).data('product-id');
        var newQuantity = $(this).val();
        updateCartQuantity(productId, newQuantity);
    });
    //
    function updateCartCount() {
        $.ajax({
            url: "{{ route('cart.quantity') }}",
            method: 'GET',
            success: function(response) {
                $('#cartCount').text(response.cartQuantity);
            },
            error: function(xhr, status, error) {
                // console.error('Lỗi khi cập nhật số lượng sản phẩm trong giỏ hàng:', error);
            }
        });
    }
    updateCartCount();
});

</script>
</html>



