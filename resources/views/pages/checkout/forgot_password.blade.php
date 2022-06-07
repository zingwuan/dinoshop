
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
  <body>
      
  <div class="form">
       
       
         <div id="login"> 

           <h1>Lấy lại mật khẩu</h1>
           @if(session()->has('message'))
           <div class="alert alert-success">
               {!! session()->get('message')!!}
           </div>
           @elseif(session()->has('error'))
           <div class="alert alert-danger">
               {!! session()->get('error')!!}
           </div>
           @endif
            
           <form action="{{URL::to('/send-mail-pass')}}" method="post">
              {{csrf_field()}}
             <div class="field-wrap">
             <input type="text" name="email_account" placeholder="Nhập email"/>
           </div>

           <button type="submit" class="button button-block">Gửi mail</button>
            
           </form>
  
         </div>
        
        
 </div> 
    
</body>
</html>
