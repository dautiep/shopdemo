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
        <form action="{{route('cart.create.order')}}" method="POST">
            @csrf
          <div class="row">
            <div class="col-50">
                <h3>Xác Nhận Thông Tin Khách Hàng</h3>
                <div class="input-group">
                    <label for="fname"><i class="fa fa-user"></i> Họ Tên</label>
                    <input type="text" id="fname" name="firstname" value="{{ $customer->name }}" placeholder="Nhập họ tên của bạn">
                    @if ($errors->has('firstname'))
                        <span class="text-danger">{{ $errors->first('firstname') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                    <input type="text" id="email" name="email" value="{{ $customer->email }}" placeholder="john@example.com">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <label for="adr"><i class="fas fa-mobile-alt"></i> Số Điện Thoại</label>
                    <input type="text" id="adr" name="phone" value="{{ $customer->phone }}" placeholder="Nhập số điện thoại của bạn">
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <label for="adr"><i class="fa fa-address-card-o"></i> Địa chỉ</label>
                    <input type="text" id="adr" name="address" placeholder="Nhập địa chỉ của bạn">
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>
                <div class="checkout_form_input country input-group">
                    <label>Tỉnh/ Thành phố</label>
                    <select class="basic" name="city">
                        <option value="">-- Chọn tỉnh thành --</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->ten_tinh }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('city'))
                        <span class="text-danger">{{ $errors->first('city') }}</span>
                    @endif
                </div>
                <input type="text" name="amountOrder" value="{{ $totalMoney }}" hidden>
            </div>

            <div class="col-50">
                <div class="container" style="display: block; border:none;">
                    <h4>Đơn Hàng <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>{{ $allQuantity }}</b></span></h4>
                    @foreach ($detailCart as $k => $detail)
                        @if ($k == count($detailCart) - 1)
                            <div class="checkout-cart" style="margin-bottom:15px;">
                                <div class="checkout-cart--image">
                                    <img class="checkout-cart--image" src="{{ RvMedia::getImageUrl($detail->getProduct->image, RvMedia::getDefaultImage()) }}" alt="{{ $detail->getProduct->name }}">
                                </div>
                                <div class="checkout-cart--text">
                                    <a href="javascript:void(0)">{{ $detail->getProduct->name }}</a>
                                </div>
                                <div class="checkout-cart--quantity">
                                    <span>{{ $detail->quantity }}</span>
                                </div>
                                @if (!empty($detail->getProduct->sale_price))
                                    <div class="checkout-cart--quantity">
                                        <span>{{ number_format($detail->getProduct->sale_price) . ' VNĐ'}}</span>
                                    </div>
                                @else
                                    <div class="checkout-cart--quantity">
                                        <span>{{ number_format($detail->getProduct->price) . ' VNĐ' }}</span>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="checkout-cart">
                                <div class="checkout-cart--image">
                                    <img class="checkout-cart--image" src="{{ RvMedia::getImageUrl($detail->getProduct->image, RvMedia::getDefaultImage()) }}" alt="{{ $detail->getProduct->name }}">
                                </div>
                                <div class="checkout-cart--text">
                                    <a href="javascript:void(0)">{{ $detail->getProduct->name }}</a>
                                </div>
                                <div class="checkout-cart--quantity">
                                    <span>{{ $detail->quantity }}</span>
                                </div>
                                @if (!empty($detail->getProduct->sale_price))
                                    <div class="checkout-cart--quantity">
                                        <span>{{ number_format($detail->getProduct->sale_price) . ' VNĐ'}}</span>
                                    </div>
                                @else
                                    <div class="checkout-cart--quantity">
                                        <span>{{ number_format($detail->getProduct->price) . ' VNĐ' }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                    <hr>
                    <p style="line-height: 80px;">Tổng tiền: <span class="price" style="color:black"><b>{{ number_format($totalMoney) . ' VNĐ' }}</b></span></p>
                </div>
            </div>

          </div>
          <input style="width:200px;" type="submit" value="Xác nhận đơn hàng" class="btn">
        </form>
      </div>
    </div>

  </div>
