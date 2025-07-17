@extends('welcome')
@section('content')
@foreach($product_details as $key => $value)
   <div class="container">
            <div class="product-content">
                <div class="product-content-left  ">
                    <div class="product-content-left-big-img">
                        <img src="{{URL::to('../uploads/product/'.$value->product_image)}}" alt="">
                    </div>
                    <div class="product-content-left-small-img">
                        <img src="{{('../frontend/images/sp2.jpg')}}" alt="">
                        <img src="{{('../frontend/images/sp1.jpg')}}" alt="">
                        <img src="{{('../frontend/images/sp1.jpg')}}" alt="">
                    </div>
                </div>
                <div class="product-content-right">
                  <div class="product-content-right-product-name">
                    <h1>{{$value->product_name}}</h1>
                    <p>MSP: {{$value->product_id}}</p>
                  </div>
                  <form action="{{URL::to('/save-cart')}}" method="POST">
                      {{csrf_field()}}
                  <div class="product-content-right-product-price">
                  <p style="color:red">{{number_format($value->product_price).' '.'VNĐ'}}</p>
                  </div>
                <div class="quantity">
                  <p style="font-weight: bold;">Số lượng:</p>
                  <input name="qty" type="number" min="1" value="1"/>
                  <input name="productid_hidden"  type="hidden"  value="{{$value->product_id}}"/>
               </div>

               <div class="product-content-right-product-button">
                  <button type="submit"><i class="fas fa-shopping-cart"></i> <p style="padding-top: 14px;">MUA HÀNG</p></button>
              </div>
              </form>

              <div class="product-content-right-product-icon">
                <div class="product-content-right-product-icon-item">
                    <i class="fas fa-phone-alt"></i> <p>Hotline</p>
                </div>
                <div class="product-content-right-product-icon-item">
                    <i class="far fa-comments"></i> <p>Chat</p>
                </div>
                <div class="product-content-right-product-icon-item">
                    <i class="far fa-envelope"></i><p>Mail</p>
                </div>
              </div>
              <div class="product-content-right-bottom">
                <div class="product-content-right-bottom-top">
                    ∨
                </div>
                <div class="product-content-right-bottom-content-big">
                    <div class="product-content-right-bottom-content-title ">
                        <div class="product-content-right-bottom-content-title-item chitiet">
                                <li>Chi tiết sản phẩm :</li>
                                <span>
                                    {{$value->product_content}}
                                </span>
                        </div>

                    </div>


                </div>
            </div>
            </div>
        </div>

     </div>
     @endforeach

<!--  -->
   <div class="container px-4 py-5" id="custom-cards" style="margin-top: 50px;">
        <h2 class="pb-2 " style="font-size: 27px;
        font-weight: 450;border-bottom: 1px solid #dee2e6;">Sản Phẩm Liên Quan</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-6 g-4">
            @foreach($relate as $key => $lienquan)
          <div class="col" style="margin-top:50px">
              <div class="card shadow-sm">
                    <img src="{{URL::to('../uploads/product/'.$lienquan->product_image)}}" width="100%" height="490px"  alt="CHÂN VÁY XẾP LY" title="CHÂN VÁY XẾP LY">
                    <div class="icon-display-combo" >
                     <img src="{{('../frontend/images/iconsale.png')}}" width="45px" alt="">
                    </div>
                    <div class="addCart">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                        </svg>
                        <ul class="side-icons">
                       <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                         </span>
                       <span>
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                         <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                         </svg>
                        </span>
                         <span>
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                        </svg>
                        </span>
                        </ul>
                   </div>
                   <div class="card-body">
                       <p class="card-text" style="font-weight: 500;">{{$lienquan->product_name}}</p>
                      <div class="d-flex justify-content-between align-items-center" style="margin-top: -6px;">
                            <p>
                           <span class="price">{{number_format($lienquan->product_price).' '.'VNĐ'}}</span>
                           <span class="old-price">250.000đ</span>
                            </p>
                      </div>
                   </div>
               </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection
