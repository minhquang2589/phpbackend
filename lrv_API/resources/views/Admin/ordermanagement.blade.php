@extends ('layout.master')
@section('main_content')
   <div>
      <h3>Order Management</h3>
   </div>
   <table class="table table-hover">
      <thead>
         <tr>
            <th scope="col">Customer Name</th>
            <th scope="col">Order Date</th>
            <th scope="col">Total Price</th>
            <th scope="col">Action</th>
         </tr>
      </thead>
      <tbody>
      @foreach($ListOrder as $value)
      <tr>
         <td>{{$value -> customer_name}}</td>
         <td>{{$value -> Oder_date}}</td>
         <td>{{$value -> Total_price}}</td>
         <td><a class="btn btn-primary" href="{{ route('orderdetail', ['id' => $value -> id]) }}">Detail</a></td>
      </tr>
      @endforeach
      </tbody>
  </table>

@endsection

@section('page_title')
   Order Management
@endsection
