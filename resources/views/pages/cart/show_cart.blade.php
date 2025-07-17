@extends('welcome')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a style="text-decoration:none" href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn </li>
				</ol>
			</div>
			
			<div class="table-responsive cart_info">
                <?php
                $content = Cart::content();
                ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td style="border-style: none;"class="">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						$total=0;
						?>
                        @foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('../uploads/product/'.$v_content->options->image)}}" width="60" alt=""/></a>
							</td>
							<td class="cart_description">
								<h4><a style="text-decoration: none;" href="">{{$v_content->name}}</a></h4>
								<p>MSP: {{$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="POST">
										{{csrf_field()}}
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}" autocomplete="off" size="2">
									<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
									<input style="border-radius:15px;margin-left:5px;margin-top:1px" type="submit" value="Cập nhật" name="update_qty" class="btn btn-primary btn-sm">
									</form>
								</div>
							</td>
							<td class="cart_total">
                            <p class="cart_total_price">
									<?php
									
                                    $subtotal = $v_content->price * $v_content->qty;
                                    echo number_format($subtotal).' '.'VNĐ';
									$total+=$subtotal;
                                    ?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        @endforeach

						
					</tbody>
				</table>
			</div>
		</div>
	</section>
    <section id="do_action">
		<div class="container">
			
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền  <span>{{Cart::subtotal(0).' '.'VNĐ'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{Cart::subtotal(0).' '.'VNĐ'}}</span></li>
						</ul>
						
				   <?php
						
						
						$customer_id = session()->get('customer_id');
						if($customer_id != NULL){
	 
						 ?>
					 
					 <form style="float:right"action="{{url('/vnpay-payment')}}" method="POST">
					   @csrf
					   <input type="hidden" name="total_vnpay" value="{{$total}}">
					<button type="submit"  class="btn btn-primary check-out " name="redirect" >Thanh toán VNPAY</a>
					</form>					 <?php
						}else{
						 ?>
                    <form style="float:right"action="{{url('/login-checkout')}}">
					   @csrf
					   <input type="hidden" name="total_vnpay" value="{{$total}}">
					<button type="submit"  class="btn btn-primary check-out " name="redirect" >Thanh toán VNPAY</a>
					</form>	 
						<?php
						}
						?>

                       <?php
						
						
						$customer_id = session()->get('customer_id');
						if($customer_id != NULL){
	 
						 ?>
					 
					 <form  action="{{url('/momo-payment')}}" method="POST">
					   @csrf
					   <input type="hidden" name="total_momo" value="{{$total}}">
					<button type="submit"  style="margin-left: 30px;" class="btn btn-primary check-out " name="payUrl" >Thanh toán MOMO</a>
					</form>			
							 <?php
						}else{
						 ?>
                    <form  action="{{url('/login-checkout')}}" >
					   @csrf
					   <input type="hidden" name="total_momo" value="{{$total}}">
					<button type="submit"  class="btn btn-primary check-out " name="payUrl" >Thanh toán MOMO</a>
					</form> 
						<?php
						}
						?>
				
					</div>
					<?php
						
						
                   $customer_id = session()->get('customer_id');
                   if($customer_id != NULL){

                    ?>
               <form action="{{URL::to('/order-place')}}" method="POST">
                {{csrf_field()}}
			    <div class="payment-options">
				<input type="submit" value="Thanh toán tiền mặt" name="send_order_place" class="btn btn-primary">

					<span>
						<label><input name="payment_option" value="2" type="checkbox"> Thanh toán tiền mặt</label>
					</span>
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Thanh toán ATM</label>
					</span>
					
					
				</div>

            </form>	
                <?php
                   }else{
                    ?>
                <a class="btn btn-primary check_out" href="{{URL::to('/login-checkout')}}">Thanh toán tiền mặt</a>

                   <?php
                   }
                   ?>
				</div>
				<div class="col-sm-6">
					<div class="total_area" style="height: 500px">
						<h5 style="text-align: center;">Thông tin giao hàng</h5>
						<div class="form-one" style="margin-left:30px ;">
								<form action="{{URL::to('/save-checkout-customer')}}" method="POST" style="width: 577px;">
									{{csrf_field()}}
									<input type="text" name="shipping_email" placeholder="Email">
									<input type="text" name="shipping_name" placeholder="Họ và tên ">
									<input type="text" name="shipping_address" placeholder="Địa chỉ">
									<input type="text" name="shipping_phone" placeholder="Phone">
									<textarea  name="shipping_note" placeholder="Ghi chú đơn hàng" rows="4"></textarea>
									<input style="width:100px;border-radius:20px" type="submit" value="Gửi" name="send_order" class="btn btn-primary">
								</form>
							</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	

@endsection