<div class="container login_block "style=" display: block ;">
    <div class="card mt-3">
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thông báo</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->has('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Thông báo!</h5>
                    {{ $errors->first() }}
                </div>
            @endif
            <form class="form" method="POST" action="{{ route('guest.post.register') }}">
                @csrf
                <div class="form-group">
                    <label>Họ Tên <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nameCustomer" name="nameCustomer" value="{{ old('nameCustomer') }}">
                    @if ($errors->has('nameCustomer'))
                        <span class="alert-register" role="alert">
                            <strong>{{ $errors->first('nameCustomer') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="emailCustomer" class="form-control" id="emailCustomer" name="emailCustomer" value="{{ old('emailCustomer') }}">
                    <small id="emailHelp" class="form-text text-muted">Chúng tôi sẽ không chia sẻ địa chỉ email của bạn cho bất cứ ai</small>
                    @if ($errors->has('emailCustomer'))
                        <span class="alert-register" role="alert">
                            <strong>{{ $errors->first('emailCustomer') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Số Điện Thoại <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="phoneCustomer" name="phoneCustomer" value="{{ old('phoneCustomer') }}">
                    @if ($errors->has('phoneCustomer'))
                        <span class="alert-register" role="alert">
                            <strong>{{ $errors->first('phoneCustomer') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mật Khẩu</label>
                    <input type="password" class="form-control" id="passwordCustomer" name="passwordCustomer">
                    @if ($errors->has('passwordCustomer'))
                        <span class="alert-register" role="alert">
                            <strong>{{ $errors->first('passwordCustomer') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Xác Thực Mật Khẩu</label>
                    <input type="password" class="form-control" id="passwordCustomerConfirm" name="passwordCustomerConfirm">
                    @if ($errors->has('passwordCustomerConfirm'))
                        <span class="alert-register" role="alert">
                            <strong>{{ $errors->first('passwordCustomerConfirm') }}</strong>
                        </span>
                    @endif
                </div>
                <span><i>Chú ý: Các trường bắt buộc nhập là các trường có dấu <span class="text-danger">*</span></i></span>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn login-btn">Đăng Ký</button>
                    </div>
                    <div class="col-md-6 text-right">
                        <span>Bạn đã đăng ký tài khoản? <a class="text-register" href="{{ route('guest.login') }}">Đăng nhập ở đây</a></span>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted header-login mb-3">
        </div>
      </div>

</div>
