<!-- PAGE CONTENT START -->
<div class="section">
	<!-- heading and description -->
	<div class="line">
	  <div class="margin">
		<div class="fullwidth" style="text-align: center;">
		  <h1 class="text-center">Sản phẩm chăm sóc sắc đẹp của bạn</h1>
		  <p class="text-center">Luôn cập nhật những mặt hàng tốt nhất</p>
		  <hr class="break-small break-center">
		</div>
	  </div>
	</div>
    <!-- products -->
	<div class="line ">
         <!-- right side start -->
         <div class="s-12 m-12 l-3" style="float: right; width:24%; height: 1000px;">
            <!-- blog search -->
            <div class="hide-s hide-m">
                <div class="fullwidth margin-bottom-20">
                    <form action="{{route('product.search')}}" class="blog-search">
                        <div class="s-9 m-9 l-9">
                            <input name="q" type="search" class="blog-search" value="{{ (!empty($key)) ? $key : '' }}" placeholder="Tìm kiếm sản phẩm">
                        </div>
                        <div class="s-3 m-3 l-3">
                            <input type="submit" value="Tìm kiếm">
                        </div>
                    </form>
                </div>
            </div>

            <!-- categories -->
            <div class="fullwidth margin-m-bottom-60" id="blog-categories">

                <h4>Danh mục</h4>
                @foreach ($categories as $category)
                <div class="s-12 m-4 l-12 cat">
                    <a href="{{ route('product.category', $category->slug) }}" title="{{ $category->name }}">{{ $category->name }} ({{ count(get_products_by_category($category->id, 9, 0)) }} sản phẩm)</a>
                </div>
                @endforeach
            </div>

        </div>
        <!-- right side end -->
		<div class="margin ">
            @if (!empty($products))
                @foreach ($products as $product)
                    <!-- product 1 -->
                    <div class=" s-12 m-4 l-3 margin-bottom-30">
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
                                    <h5 class="text--product">{{ $product->name }}</h5>
                                </a>
                                @if (!empty($product->sale_price))
                                    <p class="text--product"><span class="strike">{{ number_format($product->sale_price) }} VNĐ</span> &nbsp;&nbsp; <span class="text-primary">{{ number_format($product->price) }} VNĐ</span></p>
                                @else
                                    <p class="text--product"><span class="text-primary">{{ number_format($product->price) }} VNĐ</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            @if (!empty($result))
                @foreach ($result as $product)
                    <!-- product 1 -->
                    <div class=" s-12 m-4 l-3 margin-bottom-30">
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
                                    <h5 class="text--product">{{ $product->name }}</h5>
                                </a>
                                @if (!empty($product->sale_price))
                                    <p class="text--product"><span class="strike">{{ number_format($product->sale_price) }} VNĐ</span> &nbsp;&nbsp; <span class="text-primary">{{ number_format($product->price) }} VNĐ</span></p>
                                @else
                                    <p class="text--product"><span class="text-primary">{{ number_format($product->price) }} VNĐ</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                @if (count($result) == 0)
                    <p class="text-center">Không tìm thấy sản phẩm!</p>
                @endif
            @endif
		</div>
	</div>
    @if (!empty($products))
        <div class="detail-pagination">
            {{ $products->links('theme.main::partials.pagination') }}
        </div>
    @endif
    @if (!empty($result))
        <div class="detail-pagination">
            {{ $result->links('theme.main::partials.pagination') }}
        </div>
    @endif
</div>
<!-- PAGE CONTENT END -->

