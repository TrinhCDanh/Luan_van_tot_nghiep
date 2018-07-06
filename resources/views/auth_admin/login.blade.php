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

    <div class="form" style="border-radius: 30px;">
      <form role="form" method="POST" action="{{ route('admin.login') }}" autocomplete="off">
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
          <input id="email" type="email" name="email"  value="{{ old('email') }}" required autofocus autocomplete="off">
          <label for="email">Email</label>
        </div>
        
        <div class="input-field col">
          <input type="password" id="password" type="password" name="password" required>
          <label for="password">Password</label>
        </div>
        
        <div class="row">
          <button class="btn waves-effect waves-light btn-login" type="submit" name="action" style="border-radius: 30px;">Đăng nhập</button>
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