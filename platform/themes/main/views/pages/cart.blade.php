<!-- PAGE CONTENT START -->
<div class="section">

	<!-- heading and description -->
	<div class="line">
		<div class="fullwidth margin-bottom-20">
			<h1 class="text-center">Giỏ hàng</h1>
			<p class="text-center">Các sản phẩm trong giỏ hàng của bạn</p>
			<hr class="break-small break-center">
		</div>
	</div>

	<!-- cart left and right -->
	<div class="line">

		<!-- cart left -->
		<div class="s-12 m-12 l-8">
            @foreach ($detailCart as $k => $detail)
                <!-- item 1 -->
                <div class="fullwidth cart-item">
                    <div class="s-12 m-4 l-3 cart-item-image">
                        <img src="{{ RvMedia::getImageUrl($detail->getProduct->image,'product-homepage', false, RvMedia::getDefaultImage()) }}" alt="">
                    </div>
                    <div class="s-12 m-8 l-9 cart-item-detail">
                        <h4>{{ $detail->getProduct->name }}</h4>
                        @if (!empty($detail->getProduct->sale_price))
                            <p>
                                Giá: <span class="strike price-cart-product">Cũ: {{ number_format($detail->getProduct->price) . ' VNĐ' }}</span>{{ 'Mới: ' . number_format($detail->getProduct->sale_price) . ' VNĐ'}}<br />
                            </p>
                        @else
                            <p>
                                Giá: {{ number_format($detail->getProduct->price) . ' VNĐ' }} <br>
                            </p>
                        @endif
                        <div class="quantity-cart">
                            <div class="quantity-text">Số Lượng:</div>
                            <div class="number-input">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                                <input class="quantity cart-{{ $detail->id }}" min="0" name="quantity" data-cart-detail-{{ $detail->id  }}={{ $detail->id }} value="{{ $detail->quantity }}" type="number">
                                <input type="text" data-quantity-product-{{ $detail->id }}={{ $detail->id }} value="{{ $detail->getProduct->quantity  }}" hidden>
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                            </div> <br>
                        </div>
                        Tổng: <span class="text-primary">{{ number_format($allPrice[$k]) }} VNĐ</span>
                        </p>
                        <p><a href="javascript:void(0)" onclick="removeCart('{{$detail->id}}')" class="remove-item">Xóa</a></p>
                        <p><a href="javascript:void(0)" onclick="updateCart('{{$detail->id}}', '{{ $detail->product_id }}')" class="update-item">Cập Nhật</a></p>
                    </div>
                </div>
            @endforeach
		</div>

		<!-- cart right -->
		<div class="s-12 m-12 l-4 margin-m-top-60 padding border-1">
			<p class="margin-bottom text-size-16">Tổng Mặt Hàng: <span class="right">{{ $allQuantity }} sản phẩm</span></p>
			<p class="margin-bottom text-size-16">Tổng Giá Trị: <span class="right">{{ number_format($totalMoney) }} VNĐ</span></p>
			<a href="{{ route('cart.checkout') }}" class="button fullwidth" style="margin-bottom: 20px;">Yêu Cầu Thanh Toán</a>
			<a href="{{ route('product.index') }}" class="button fullwidth">Tiếp Tục Mua Hàng</a>
		</div>

	</div>
</div>
<!-- PAGE CONTENT END -->
