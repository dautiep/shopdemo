<!-- PAGE CONTENT START -->
<div class="section">
	<!-- heading and description -->
	<div class="line">
	  <div class="margin">
		<div class="fullwidth" style="text-align: center;">
		  <h1 class="text-center">Sản phẩm chăm sóc sắc đẹp của bạn</h1>
		  <p class="text-center">Luôn cập nhật những mặt hàng tốt nhất</p>
		  <hr class="break-small break-center">
          {{-- @includeIf('theme.main::partials.search') --}}
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
                    <form class="blog-search">
                        <div class="s-9 m-9 l-9">
                            <input type="search" class="blog-search" placeholder="Tìm kiếm bài viết">
                        </div>
                        <div class="s-3 m-3 l-3">
                            <input type="submit" value="Tìm kiếm">
                        </div>
                    </form>
                </div>
            </div>

            <!-- recent posts start -->
            <div class="fullwidth margin-m-bottom-60" id="recent-posts">
                <h4>Tin tức khác</h4>
                {{-- @foreach (get_related_by_category($contentPost->id, get_category_post_by_id(get_category_by_post_id($contentPost->id)->category_id)->id, 6) as $relatePost) --}}
                    <!-- post 1 -->
                    <div class="s-12 m-4 l-12 post">
                        <div class="s-3 m-3 l-3 thumb">
                            <img src="" alt="" class="fullwidth">
                        </div>
                        <div class="s-9 m-9 l-9 title">
                            <a href="">tên 1 kkkk</a>
                        </div>
                    </div>
                {{-- @endforeach --}}
            </div>

            <!-- categories -->
            <div class="fullwidth margin-m-bottom-60" id="blog-categories">

                <h4>Danh mục</h4>
                {{-- @foreach (get_all_categories() as $category) --}}
                <div class="s-12 m-4 l-12 cat">
                    <a href="#UUU"> Bài Viết</a>
                </div>
                {{-- @endforeach --}}
            </div>

            <!-- tags -->
            <div class="fullwidth margin-m-bottom-60" id="recent-tags">

                <h4 class="margin-bottom-30">Recent Tags</h4>

                <a href="" class="tag">Beauty</a>
                <a href="" class="tag">Beauty Care</a>
                <a href="" class="tag">Natural Beauty Care</a>
                <a href="" class="tag">Lips</a>
                <a href="" class="tag">Hair</a>
                <a href="" class="tag">Hair Care</a>

            </div>

        </div>
        <!-- right side end -->
		<div class="margin ">
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

 