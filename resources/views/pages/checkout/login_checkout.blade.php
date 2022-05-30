
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="{{ asset('../assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{asset('../frontend/css/signin.css')}}" rel="stylesheet">
  </head>
  <body class="">
  <div class="form">
       
       <ul class="tab-group">
       
         <li class="tab active"><a href="#signup">Đăng Ký</a></li>
         <li class="tab"><a href="#login">Đăng Nhập</a></li>
       </ul>
        
       <div class="tab-content">
       <div id="signup">   
           <h1>Đăng ký tài khoản</h1>
            
           <form action="{{URL::to('/add-customer')}}" method="post">
               {{csrf_field()}}
            
           <div class="field-wrap">
             <label>
               Họ và tên<span class="req">*</span>
             </label>
             <input type="text" name="customer_name" required autocomplete="off"/>
           </div>
  
           <div class="field-wrap">
             <label>
               Địa chỉ email<span class="req">*</span>
             </label>
             <input type="email" name="customer_email" required autocomplete="off"/>
           </div>
            
           <div class="field-wrap">
             <label>
               Mật khẩu<span class="req">*</span>
             </label>
             <input type="password" name="customer_password" required autocomplete="off"/>
           </div>

           <div class="field-wrap">
             <label>
               Phone<span class="req">*</span>
             </label>
             <input type="text" name="customer_phone" required autocomplete="off"/>
           </div>
            
           <button type="submit" class="button button-block"/>Đăng ký</button>
            
           </form>
  
         </div>
         <div id="login">   
           <h1>Đăng nhập tài khoản</h1>
            
           <form action="/" method="post">
            
             <div class="field-wrap">
             <label>
               Tài khoản<span class="req">*</span>
             </label>
             <input type="email" name="email_account"required autocomplete="off"/>
           </div>
            
           <div class="field-wrap">
             <label>
               Mật khẩu<span class="req">*</span>
             </label>
             <input type="password"required autocomplete="off"/>
           </div>
            
           <p class="forgot"><a href="#">Lấy lại mật khẩu</a></p>
            
           <button class="button button-block">Đăng nhập</button>
            
           </form>
  
         </div>
         
          
       </div><!-- tab-content -->
        
 </div> 
    <script src="{{ asset('../frontend/js/jquery.min.js')}}"></script>
    <script type="text/javascript">
        $('.form').find('input, textarea').on('keyup blur focus', function (e) {
   
   var $this = $(this),
       label = $this.prev('label');
  
       if (e.type === 'keyup') {
             if ($this.val() === '') {
           label.removeClass('active highlight');
         } else {
           label.addClass('active highlight');
         }
     } else if (e.type === 'blur') {
         if( $this.val() === '' ) {
             label.removeClass('active highlight'); 
             } else {
             label.removeClass('highlight');   
             }   
     } else if (e.type === 'focus') {
        
       if( $this.val() === '' ) {
             label.removeClass('highlight'); 
             } 
       else if( $this.val() !== '' ) {
             label.addClass('highlight');
             }
     }
  
 });
  
 $('.tab a').on('click', function (e) {
    
   e.preventDefault();
    
   $(this).parent().addClass('active');
   $(this).parent().siblings().removeClass('active');
    
   target = $(this).attr('href');
  
   $('.tab-content > div').not(target).hide();
    
   $(target).fadeIn(600);
    
 });
    </script>
  </body>
</html>
