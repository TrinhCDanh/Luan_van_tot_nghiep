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


@extends('layouts.master')
@section('content')
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

        
        <div class="input-field col">
          <!-- <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus> -->
          <input id="email" type="email" name="email"  value="{{ old('email') }}" required autofocus>
          <label for="email">Email</label>
        </div>
        
        <div class="input-field col">
          <input type="password" id="password" type="password" name="password" required>
          <label for="password">Password</label>
        </div>
        
        <div class="row">
          <button class="btn waves-effect waves-light btn-login" type="submit" name="action">Đăng nhập</button>
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
@endsection
