<div class="container login_block" style=" display: block ;">
    <div class="card mt-3">
        <div class="card-body">
            <form class="form" action="{{ route('login.post') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Chúng tôi sẽ không chia sẻ địa chỉ email của bạn cho bất cứ ai</small>
                    @if ($errors->has('email'))
                        <span class="alert-register" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mật Khẩu</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                    @if ($errors->has('password'))
                        <span class="alert-register" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" class="btn login-btn">Đăng Nhập</button>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="form-group">
                        <span>Bạn chưa có tài khoản? <a class="text-register" href="{{ route('guest.register') }}">Đăng ký ở đây</a></span> <br>
                        <span><a class="text-register" href="{{ route('guest.forget.password') }}">Quên mật khẩu</a></span>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted header-login mb-3">
        </div>
      </div>
</div>
