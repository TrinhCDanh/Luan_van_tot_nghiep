<div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form role="form" method="POST" action="{{ route('giangvien.login') }}">
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
</div>  