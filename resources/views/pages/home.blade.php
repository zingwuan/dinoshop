
@extends('welcome')
@section('content')
<section class="py-5 text-center container" style="height: 250px;">
        <div class="row py-lg-5">
          <div class="col-lg-6 col-md-8 mx-auto">
            <h2 class="" style="font-size: 40px;"> Sản  Phẩm Nổi Bật</h1>
              <p>
                <a href="#" class="btn btn-primary my-2">Tất cả sản phẩm</a>
                <a href="#" class="btn btn-secondary my-2">Hàng Sale 20%</a>
              </p>
          </div>
        </div>
      </section>
<div class="album py-5 bg-light">

        <div class="container">
         
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
           @foreach($all_product as $key => $product)
           
            <div class="col">
              <div class="card shadow-sm">
               <a href="{{URL::to('/product-details/'.$product->product_id)}}"> 
                   <img src="{{URL::to('uploads/product/'.$product->product_image)}}" width="100%" height="490px"  >
                </a>
                <div class="icon-display-combo" >
                 <img src="{{ asset('../frontend/images/iconsale.png')}}" width="45px" alt="">
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
                  <p class="card-text" style="font-size:15px">{{$product->product_name}}</p>
                  <div class="d-flex justify-content-between align-items-center" style="margin-top: -6px;">
                    <p>
                      <span class="price">{{number_format($product->product_price).' '.'VNĐ'}}</span>
                      <span class="old-price">250.000 VNĐ</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            
            @endforeach
            
            
            
              
        <div class="col-lg-1  mx-auto">
          <a style="text-decoration: none;"href="">xem thêm ...</a>
            
        </div>
      </div>
      <section class="py-5 text-center container" style="height: 250px;">
        <div class="row py-lg-5">
          <div class="col-lg-6 col-md-8 mx-auto">
            <h2 class="" style="font-size: 40px;"> Sản Phẩm Bán Chạy</h1>
              <p>
                <a href="#" class="btn btn-primary my-2">Tất cả sản phẩm</a>
                <a href="#" class="btn btn-secondary my-2">Hàng Sale 20%</a>
              </p>
          </div>
        </div>
      </section>
    
      <div class="album py-5 bg-light">
        <div class="container">
    
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
          @foreach($all_product as $key => $product)
            <div class="col">
              <div class="card shadow-sm">
              <a href=""><img src="{{URL::to('uploads/product/'.$product->product_image)}}" width="100%" height="490px"> </a>
                <div class="icon-display-combo" >
                  <img src="{{ asset('../frontend/images/iconsale1.png')}}" width="45px" alt="">
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
                  <p class="card-text" style="font-weight: 500;">{{$product->product_name}}</p>
                  <div class="d-flex justify-content-between align-items-center" style="margin-top: -6px;">
                    <p>
                      <span class="price">{{number_format($product->product_price).' '.'VNĐ'}}</span>
                      <span class="old-price">199.000đ</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            
        <div class="col-lg-1  mx-auto">
          <a style="text-decoration: none;"href="">xem thêm ...</a>
            
        </div>
      </div>

@endsection