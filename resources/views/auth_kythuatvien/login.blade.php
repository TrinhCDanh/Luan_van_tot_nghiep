{{-- <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form role="form" method="POST" action="{{ route('kythuatvien.login') }}">
          {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input id="email" type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
        <div class="form-group has-feedback">
            <input type="password" id="password" type="password" class="form-control" name="password" placeholder="Password" required autofocus>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
        <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
      </div>
  </form>
</div>   --}}

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <title>Login - Kỹ thuật viên</title>
  
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      @import url("https://fonts.googleapis.com/css?family=Roboto");
      @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css");
      * { box-sizing : border-box; }
      html { height: 100%; }
      body {
        /*background-color: #1a8fb4;*/
        background-image: url('http://hdqwalls.com/download/blur-blue-gradient-cool-background-sp-1920x1080.jpg');
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
        height: 100%;
        display: flex;
        align-content: center;
      }
      .login-content {
        /*width: 100%;*/margin: auto;
      }
      .owl {
        margin: auto;
        width: 211px;
        height: 108px;
        background-image: url("https://dash.readme.io/img/owl-login.png");
        position: relative;
      }
      .owl .hand {
        width: 34px;
        height: 34px;
        border-radius: 40px;
        background-color: #472d20;
        transform: scaleY(0.6);
        position: absolute;
        left: 14px;
        bottom: -8px;
        transition: 0.3s ease-out;
      }
      .owl .hand.password {
        transform: translateX(42px) translateY(-15px) scale(0.7);
      }
      .owl .hand.hand-r {
        left: 170px;
      }
      .owl .hand.hand-r.password {
        transform: translateX(-42px) translateY(-15px) scale(0.7);
      }
      .owl .arms {
        position: absolute;
        top: 58px;
        height: 41px;
        width: 100%;
        overflow: hidden;
      }
      .owl .arms .arm {
        width: 40px;
        height: 65px;
        background-image: url("https://dash.readme.io/img/owl-login-arm.png");
        position: absolute;
        left: 20px;
        top: 40px;
        transition: 0.3s ease-out;
      }
      .owl .arms .arm.password {
        transform: translateX(40px) translateY(-40px);
      }
      .owl .arms .arm.arm-r {
        left: 158px;
        transform: scaleX(-1);
      }
      .owl .arms .arm.arm-r.password {
        transform: translateX(-40px) translateY(-40px) scaleX(-1);
      }
      .form {
        margin: auto;
        margin-top: -9px;
        padding: 30px;
        /*background-color: #fff;*/
        background-color: rgba(0,0,0,0.5);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        width: 300px;
      }
      .form .form-group {
        margin-bottom: 10px;
        width: 100%;
      }
      .form .control label {
        position: absolute;
        font-size: 16px;
        top: 11px;
        left: 9px;
        color: rgba(0,0,0,0.3);
      }
      .form .form-control {
        /*padding: 9px 6px 9px 30px;*/
        padding: 8px 10px;
        /*border-radius: 4px;*/
        /*border: 1px solid #ccc;*/
        font-size: 14px;
        width: 100%;
        background-color: rgba(0,0,0,0.5);
        color: white;
      }

  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>

  <div class="login-content">
    
    <div class="owl">
      <div class="hand"></div>
      <div class="hand hand-r"></div>

      <div class="arms">
        <div class="arm"></div>
        <div class="arm arm-r"></div>
      </div>
    </div>

    <div class="form">
      <form role="form" method="POST" action="{{ route('kythuatvien.login') }}">
        {{ csrf_field() }}

        @if ($errors->has('email'))
          <div class="alert alert-danger">
            <strong>{{ $errors->first('email') }}</strong>
          </div>
        @endif
        @if ($errors->has('password'))
          <div class="alert alert-danger">
            <strong>{{ $errors->first('password') }}</strong>
          </div>
        @endif

        <div class="form-group has-feedback">
          <input id="email" type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
          {{-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> --}}
        </div>
        
        <div class="form-group has-feedback">
            <input type="password" id="password" type="password" class="form-control" name="password" placeholder="Password" required autofocus>
            {{-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> --}}
        </div>
        
        <div class="row">
          <div class="col-xs-12" style="text-align: center;">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
          </div>
        </div>
      </form>
    </div>

  </div>
  
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script type="text/javascript">
    $('input[type="password"]').on('focus', function () {
      $('*').addClass('password');
    }).on('focusout', function () {
      $('*').removeClass('password');
    });;
  </script>

</body>

</html>
