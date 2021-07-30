<div class="container login_block" style=" display: block ;">
    <div class="card mt-3">
        <div class="card-body">
            <form class="form" action="{{ route('guest.post.forget.password') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="exampleInputEmail1">Email lấy lại mật khẩu</label>
                    <input type="text" name="email" class="form-control">
                    @if ($errors->has('email'))
                        <span class="alert-register" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" class="btn login-btn">Xác Nhận</button>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="form-group">
                        <span>Bạn đã có tài khoản? <a class="text-register" href="{{ route('guest.login') }}"> Đăng nhập ở đây</a></span> <br>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted header-login mb-3">
        </div>
      </div>
</div>
