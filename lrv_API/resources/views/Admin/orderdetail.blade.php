@extends ('layout.master')
@section('main_content')
   <div>
      <h2>Order Detail</h2>
   </div>

   <table class="table table-hover">
      <thead>
         <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Total</th>
            <th scope="col">Qty</th>
         </tr>
      </thead>
      <tbody>
         @foreach( $listorderdetail as $value)
      <tr>
         <td>{{ $value ->  product_name}}</td>
         <td>{{ $value -> Price}}</td>
         <td>{{ $value -> qty}}</td>
      </tr>
         @endforeach
      </tbody>
   </table>
   <h6 class="mt-3"><strong>Customer Name:</strong> {{ $customer -> Name }}</h6>
   <h6><strong>Order Date:</strong> {{ $order -> Oder_date }}</h6>
   <h6> <strong>Total Price:</strong> {{ $order -> Total_price }}đ</h6>   
   <a class="btn btn-primary  mt-2" href="{{ route('invoice', ['id' => $order->id, 'download' => TRUE]) }}" target="_blank">In hoá đơn</a>
   <!-- <a class="btn btn-danger" id="showOrderDetailBtn">Xem chi tiết đơn hàng</a> -->
   <tbody id="orderDetail">
        <!-- Nội dung chi tiết đơn hàng sẽ được thêm vào đây bằng JavaScript -->
    </tbody>
@endsection
@section('page_title')
   Order Detail
@endsection

<!-- @section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("showOrderDetailBtn").addEventListener("click", function() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "{{ route('orderdetailpreview', $order->id) }}", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        // Hiển thị thông tin đơn hàng
                        document.getElementById("customerName").innerText = response.order.customer.name;
                        document.getElementById("orderDate").innerText = response.order.Oder_date;
                        document.getElementById("totalPrice").innerText = response.order.Total_price;
                        // Hiển thị chi tiết đơn hàng
                        var orderDetailsHtml = "";
                        response.orderDetails.forEach(function(detail) {
                            orderDetailsHtml += "<tr><td>" + detail.product_name + "</td><td>" + detail.Price + "</td><td>" + detail.qty + "</td></tr>";
                        });
                        document.getElementById("orderDetail").innerHTML = orderDetailsHtml;
                    } else {
                        console.error("Đã xảy ra lỗi: " + xhr.status);
                    }
                }
            };
            xhr.send();
        });
    });
</script>
@endsection -->
