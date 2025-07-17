
@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin khách hàng
    </div>
    
    <div class="table-responsive">
  
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$customer_info->customer_name}}</td>
            <td>{{$customer_info->customer_email}}</td>
            <td>{{$customer_info->customer_phone}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br></br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
    
    <div class="table-responsive">
   
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận </th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$shipping_info->shipping_name}}</td>
            <td>{{$shipping_info->shipping_address}}</td>
            <td>{{$shipping_info->shipping_phone}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br></br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết đơn hàng
    </div>
    
    
    <div class="table-responsive">
    
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá </th>
            <th>Tổng tiền</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($order_by_id as $orrder)
          <tr>
            <td>{{$orrder->product_name}}</td>
            <td>{{$orrder->product_sales_quantity}}</td>
            <td>{{$orrder->product_price}}</td>
            <td>{{$orrder->product_price * $orrder->product_sales_quantity }}</td>
          </tr>
          @endforeach
       
        

        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection