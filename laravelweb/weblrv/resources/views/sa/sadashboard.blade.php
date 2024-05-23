<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@vite('resources/css/app.css')
@vite('resources/css/header/header.css')
<style>
 

</style>
</head>
  @include('layout.header')
<body>
<!--  -->
<span class="flex items-center">
    <span class="h-px flex-1 bg-slate-200"></span>
</span>
<!-- content -->
      <div>
          @yield('content')
      </div>
    @if (Auth::check())
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
            clearTimeout(timer); // Xóa bất kỳ thời gian chờ nào còn tồn tại
            timer = setTimeout(function() {
                if (!document.querySelector("header").classList.contains("active")) {
                    document.querySelector("header").classList.add("active");
                }
            }, 1000); // Thời gian chờ 1 giây (1000 mili giây)
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
        var formData = $(this).closest('form').serialize();
        var addToCartForm = $(this).closest('form');
        $.ajax({
            url: addToCartForm.attr('action'), 
            method: 'POST',
            data: formData,
            success: function(response) {
                // console.log('Sản phẩm đã được thêm vào giỏ hàng');
                updateCartQuantity();
            },
            error: function(xhr, status, error) {
                // console.error('Lỗi khi thêm sản phẩm vào giỏ hàng:', error);
            }
        });
        return false; 
    });

    function updateCartQuantity(productId, newQuantity) {
      $.ajax({
          url: "{{ route('cart.quantity') }}",
          method: 'GET',
          data: {
              product_id: productId,
              quantity: newQuantity
          },
          success: function(response) {
              // console.log('Số lượng được cập nhật thành công');

          },
          error: function(xhr, status, error) {
              // console.error('Lỗi khi cập nhật số lượng sản phẩm:', error);
          }
      });

    }
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



