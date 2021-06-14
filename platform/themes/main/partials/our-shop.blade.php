<!-- PRODUCTS TAB START -->
<div class="section">
	<div class="line">
	  <!-- heading -->
	  <h2 class="text-center"><span class="text-primary">Sản </span> Phẩm </h2>
	  <hr class="break-small break-center">
		<!-- products tabs start -->
		<div class="tabs">
		    <!-- tab 1 start -->
			<div class="tab-item tab-active">
				<a class="tab-label active-btn">Chăm sóc da</a>
				<div class="tab-content">
					<div class="margin">
                    @foreach ($producSkincare as $product)
                        <!-- Product 1 -->
                        <div class="s-12 m-4 l-3 margin-bottom-30">
                            <div class="fullwidth">
                                <figure class="imghvr-reveal-down">
                                    <img src="{{ RvMedia::getImageUrl($product->image,'product-homepage', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                                    <figcaption>
                                        <div class="product-hover-content">
                                            <div class="btn-box">
                                                <a href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" class="btn" title="{{ $product->name }}">Mua ngay</a>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="fullwidth">
                                <a class="product-feature" href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" title="{{ $product->name }}">
                                    <h5 class="text--product">{{ $product->name }}</h5>
                                </a>
                                @if (!empty($product->sale_price))
                                    <p class="text--product"><span class="strike">{{ number_format($product->sale_price) }} VNĐ</span> &nbsp;&nbsp; <span class="text-primary">{{ number_format($product->price) }} VNĐ</span></p>
                                @else
                                    <p class="text--product"><span class="text-primary">{{ number_format($product->price) }} VNĐ</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
					</div>
				</div>
			</div>
			<!-- tab 1 end -->

			<!-- tab 2 start -->
			<div class="tab-item">
				<a class="tab-label">Chăm sóc cơ thể</a>
				<div class="tab-content">
					<div class="margin">
                        <!-- Product 1 -->
                        @foreach ($producBody as $product)
                            <!-- Product 1 -->
                            <div class="s-12 m-4 l-3 margin-bottom-30">
                                <div class="fullwidth">
                                    <figure class="imghvr-reveal-down">
                                        <img src="{{ RvMedia::getImageUrl($product->image,'product-homepage', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                                        <figcaption>
                                            <div class="product-hover-content">
                                                <div class="btn-box">
                                                    <a href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" class="btn" title="{{ $product->name }}">Mua ngay</a>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="fullwidth">
                                    <a class="product-feature" href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" title="{{ $product->name }}">
                                        <h5 class="text--product">{{ $product->name }}</h5>
                                    </a>
                                    @if (!empty($product->sale_price))
                                        <p class="text--product"><span class="strike">{{ number_format($product->sale_price) }} VNĐ</span> &nbsp;&nbsp; <span class="text-primary">{{ number_format($product->price) }}</span></p>
                                    @else
                                        <p class="text--product"><span class="text-primary">{{ number_format($product->price) }} VNĐ</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <!-- Product end -->
					</div>
				</div>
			</div>
			<!-- tab 2 end -->

			<!-- tab 3 start -->
			<div class="tab-item">
				<a class="tab-label">Trang điểm</a>
				<div class="tab-content">
					<div class="margin">
                        <!-- Product 1 -->
                        @foreach ($producMakeup as $product)
                            <!-- Product 1 -->
                            <div class="s-12 m-4 l-3 margin-bottom-30">
                                <div class="fullwidth">
                                    <figure class="imghvr-reveal-down">
                                        <img src="{{ RvMedia::getImageUrl($product->image,'product-homepage', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                                        <figcaption>
                                            <div class="product-hover-content">
                                                <div class="btn-box">
                                                    <a href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" class="btn"  title="{{ $product->name }}">Mua ngay</a>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="fullwidth">
                                    <a class="product-feature" href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" title="{{ $product->name }}">
                                        <h5 class="text--product">{{ $product->name }}</h5>
                                    </a>
                                    @if (!empty($product->sale_price))
                                        <p class="text--product"><span class="strike">{{ number_format($product->sale_price) }} VNĐ</span> &nbsp;&nbsp; <span class="text-primary">{{ number_format($product->price) }}</span></p>
                                    @else
                                        <p class="text--product"><span class="text-primary">{{ number_format($product->price) }} VNĐ</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <!-- Product end -->
					</div>
				</div>
			</div>
			<!-- tab 3 end -->

			<!-- tab 4 start -->
			<div class="tab-item">
				<a class="tab-label">Phụ kiện</a>
				<div class="tab-content">
					<div class="margin">
                        <!-- Product 1 -->
                        @foreach ($producAccessories as $product)
                            <!-- Product 1 -->
                            <div class="s-12 m-4 l-3 margin-bottom-30">
                                <div class="fullwidth">
                                    <figure class="imghvr-reveal-down">
                                        <img src="{{ RvMedia::getImageUrl($product->image,'product-homepage', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                                        <figcaption>
                                            <div class="product-hover-content">
                                                <div class="btn-box">
                                                    <a href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" class="btn"  title="{{ $product->name }}">Mua ngay</a>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="fullwidth">
                                    <a class="product-feature" href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" title="{{ $product->name }}">
                                        <h5 class="text--product">{{ $product->name }}</h5>
                                    </a>
                                    @if (!empty($product->sale_price))
                                        <p class="text--product"><span class="strike">{{ number_format($product->sale_price) }} VNĐ</span> &nbsp;&nbsp; <span class="text-primary">{{ number_format($product->price) }}</span></p>
                                    @else
                                        <p class="text--product"><span class="text-primary">{{ number_format($product->price) }} VNĐ</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <!-- Product end -->
					</div>
				</div>
			</div>
			<!-- tab 4 end -->
		</div>
		<!-- products tabs end -->
	</div>
</div>
<!-- PRODUCTS END -->
