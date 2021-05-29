<div class="container">
    <div class="card mt-3">
        <div class="card-header header-login">
          ĐĂNG NHẬP
        </div>
        <div class="card-body">
            <form class="form">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Chúng tôi sẽ không chia sẻ địa chỉ email của bạn cho bất cứ ai</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mật Khẩu</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group form-check">
                {{-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> --}}
                {{-- <label class="form-check-label" for="exampleCheck1">Check me out</label> --}}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn login-btn">Đăng Nhập</button>
                    </div>
                    <div class="col-md-6 text-right">
                        <span>Bạn chưa có tài khoản? <a class="text-register" href="{{ route('guest.register') }}">Đăng ký ở đây</a></span>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted header-login mb-3">
        </div>
      </div>

</div>
