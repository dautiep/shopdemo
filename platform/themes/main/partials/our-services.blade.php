<!-- BRAND OVERVIEW START -->
<div class="background-dark section">
	<div class="line">
	  <!-- heading -->
	  <h2 class="text-white text-center">Sản Phẩm Nổi Bật</h2>
	  <hr class="break-small break-center">
		<!-- slideshow start -->
		<div class="carousel-blocks">
            <!-- slideshow item 1 -->
            @foreach ($productFeature as $product )
                <div class="item">
                    <div class="fullwidth">
                        <figure class="imghvr-reveal-down">
                            <img src="{{ RvMedia::getImageUrl($product->image)  }}">
                            <figcaption>
                                <div class="product-hover-content">
                                    <div class="btn-box">
                                        <a href= "{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" class="btn">Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="fullwidth">
                    <a class="product-feature" href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}">
                        <p class="text-white text-center">{{$product->name}}</p>
                    </a>
                    <p class="text-center"><span class="text-dark-light">Giá từ</span> - <span class="text-primary">{{ number_format($product->price) }} VNĐ</span></p>
                    </div>
                </div>
            @endforeach
		</div>
		<!-- slideshow end -->
	</div>
</div>
