<!-- PAGE CONTENT START -->
<div class="section">
	<!-- heading and description -->
	<div class="line">
	  <div class="margin">
		<div class="fullwidth">
		  <h1 class="text-center">Sản phẩm chăm sóc sắc đẹp của bạn</h1>
		  <p class="text-center">Luôn cập nhật những mặt hàng tốt nhất</p>
		  <hr class="break-small break-center">
		</div>
	  </div>
	</div>

    <!-- products -->
	<div class="line">
		<div class="margin">
            @foreach ($products as $product)
                <!-- product 1 -->
                <div class="s-12 m-4 l-3 margin-bottom-30">
                    <div class="margin">
                        <div class="fullwidth">
                            <figure class="imghvr-reveal-down">
                                <img src="{{ RvMedia::getImageUrl($product->image,'product-homepage', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                                <figcaption>
                                    <div class="product-hover-content">
                                        <div class="btn-box">
                                            <a href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" class="btn">Mua ngay</a>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="fullwidth">
                            <a class="product-feature" href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" title="{{ $product->name }}">
                                <h5>{{ $product->name }}</h5>
                            </a>
                            <p class="text-center"><span class="strike">{{ $product->price }} VNĐ</span> &nbsp;&nbsp; <span class="text-primary">$130.00</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
		</div>
	</div>
    <div class="detail-pagination">
        {{ $products->links('theme.main::partials.pagination') }}
    </div>
</div>
<!-- PAGE CONTENT END -->
