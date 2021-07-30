<style>
    .text-danger {
        color: #dc3545;
    }
    .basic {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    .checkout_form_input {
        float:left;
    }

    .checkout_form .country .fancy-select .trigger {
        width:100%;
    }
    .checkout_form_input {width:100%; margin-right:15px;}
}
</style>
<div class="row row_all">
    <div class="col-75">
      <div class="container" style="display: block; border:none;">
        <form action="{{ route('cart.payment.ship') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-50">
                    <h3>Thông Tin Đơn Hàng</h3>
                    <div class="input-group">
                        <label for="fname"><i class="fa fa-user"></i> Họ Tên</label>
                        <p>{{ $nameCustomer }}</p>
                    </div>
                    <div class="input-group">
                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                        <p>{{ $emailCustomer }}</p>
                    </div>
                    <div class="input-group">
                        <label for="adr"><i class="fas fa-mobile-alt"></i> Số Điện Thoại</label>
                        <p>{{ $phoneCustomer }}</p>
                    </div>
                    <div class="input-group">
                        <label for="adr"><i class="fa fa-address-card-o"></i> Địa chỉ</label>
                        <p>{{ $address }}</p>
                    </div>
                    <div class="input-group">
                        <label for="adr">Tổng tiền</label>
                        <p>{{ number_format($amount) }} VNĐ</p>
                    </div>
                </div>
            </div>
            <input style="width:200px;" type="submit" value="Thanh Toán Sau" class="btn">
            <a href="{{ route('paymet.Getonline', $order) }}" class="btn" style="width:200px;">Thanh Toán Qua VNPay</a>
        </form>
      </div>
    </div>

  </div>
