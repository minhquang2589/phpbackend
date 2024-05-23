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
<script>
$(document).ready(function () {
    $('[id^="addToCartBtn"]').click(function (event) {
        event.preventDefault();
        var formData = $(this).closest('form').serialize();
        var addToCartForm = $(this).closest('form');
        
        $.ajax({
            url: addToCartForm.attr('action'), 
            method: 'POST',
            data: formData,
            success: function(response) {
                updateCartCount();
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi thêm sản phẩm vào giỏ hàng:', error);
            }
        });
    });
    function updateCartCount() {
        $.ajax({
            url: "{{ route('cart.quantity') }}",
            method: 'GET',
            success: function(response) {
                $('#cartCount').text(response.cartQuantity);
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi cập nhật số lượng sản phẩm trong giỏ hàng:', error);
            }
        });
    }

    updateCartCount();
});
</script>
  @include('layout.footer')
</body>
</html>



