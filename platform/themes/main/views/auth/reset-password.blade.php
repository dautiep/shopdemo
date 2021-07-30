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
            <form class="form" method="POST" action="{{ route('guest.post.reset.password', $user->id) }}">
                @csrf
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
                <div class="col-md-6">
                    <button type="submit" class="btn login-btn">Thay đổi mật khẩu</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted header-login mb-3">
        </div>
      </div>

</div>
