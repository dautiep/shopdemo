
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
        <form action="{{route('paymet.online')}}" method="POST">
            @csrf
            <div class="row">
                <p>Thanh Toán qua VNPay</p>
            </div>
            <div class="row">
                <div class="col-50">
                    <div class="input-group">
                        <label for="fname">Hình Thức Thanh Toán</label>
                        <input type="text" id="fname" name="firstname" value="Thanh toán qua VNPay" disabled>
                        <input type="text" name="order_type" value="billpayment" hidden>
                    </div>
                    <div class="input-group">
                        <label>Mã hóa đơn</label>
                        <input class="form-control" name="order_id" type="text" value="{{ $order->id }}" disabled/>
                        <input type="text" name="orderId" value="{{ $order->id }}" hidden>
                    </div>
                    <div class="input-group">
                        <label for="amount">Số tiền: (VNĐ)</label>
                        <input class="form-control"  name="amountText" type="text" value="{{ number_format($order->sub_total)}}" disabled/>
                        <input type="text" name="amount" value="{{ $order->sub_total }}" hidden>
                    </div>
                </div>

                <div class="col-50">
                    <div class="input-group">
                        <label for="order_desc">Nội dung thanh toán</label>
                        <input class="form-control"  name="order_desc" type="text" value="" placeholder="noi dung thanh toan"/>
                    </div>
                    <div class="input-group">
                        <label for="bank_code">Ngân hàng</label>
                        <select name="bank_code" id="bank_code" class="basic">
                            <option value="">Không chọn</option>
                            <option value="NCB"> Ngan hang NCB</option>
                            <option value="AGRIBANK"> Ngan hang Agribank</option>
                            <option value="SCB"> Ngan hang SCB</option>
                            <option value="SACOMBANK">Ngan hang SacomBank</option>
                            <option value="EXIMBANK"> Ngan hang EximBank</option>
                            <option value="MSBANK"> Ngan hang MSBANK</option>
                            <option value="NAMABANK"> Ngan hang NamABank</option>
                            <option value="VNMART"> Vi dien tu VnMart</option>
                            <option value="VIETINBANK">Ngan hang Vietinbank</option>
                            <option value="VIETCOMBANK"> Ngan hang VCB</option>
                            <option value="HDBANK">Ngan hang HDBank</option>
                            <option value="DONGABANK"> Ngan hang Dong A</option>
                            <option value="TPBANK"> Ngân hàng TPBank</option>
                            <option value="OJB"> Ngân hàng OceanBank</option>
                            <option value="BIDV"> Ngân hàng BIDV</option>
                            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                            <option value="VPBANK"> Ngan hang VPBank</option>
                            <option value="MBBANK"> Ngan hang MBBank</option>
                            <option value="ACB"> Ngan hang ACB</option>
                            <option value="OCB"> Ngan hang OCB</option>
                            <option value="IVB"> Ngan hang IVB</option>
                            <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="language">Ngôn ngữ</label>
                        <select name="language" id="language" class="basic">
                            <option value="vn">Tiếng Việt</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                </div>

            </div>
          <input style="width:200px;" type="submit" value="Xác Nhận Thanh Toán" class="btn">
        </form>
      </div>
    </div>
  </div>






