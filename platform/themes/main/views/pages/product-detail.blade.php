
<!-- PRODUCT DETAIL START -->
<div class="section">
    <div class="line">
        <div class="margin">
            <!-- product image -->
            <div class="s-12 m-4 l-5 margin-bottom">
                    <img id="expandedImg" style="width:100%" src="{{ RvMedia::getImageUrl($product->image) }}" />
                    <!-- Close the image -->
                    <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>

                    <!-- Expanded image -->

                    <!-- Image text -->
                    <div id="imgtext"></div>

                <div class="row">
                    @foreach ($product->images as $image)
                        <div class="column">
                            <img style="height: 100px;" src="{{ RvMedia::getImageUrl($image)  }}" alt="Nature" onclick="myFunction(this);">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- product detail -->
            <div class="s-12 m-8 l-7 padding-l-left">
                <h2 class="text-primary product-name">{{ $product->name }}</h2>
                <p class="text-justify">
                    {!! $product->description !!}
                </p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <div class="fullwidth margin-bottom-40">
                        <div class="numbers-row">
                            <label>Số lượng:</label>
                            <input type="number" name="quantityProduct" class="quantity" id="french-hens" value="1">
                            <input type="number" id="total-store" value="{{ $product->quantity }}" hidden>
                            <div class="inc quantity-btn">+</div>
                            <div class="dec quantity-btn">-</div>
                        </div>
                        <input type="text" name="productId" value="{{$product->id}}" hidden>

                    </div>
                    <div class="s-12 m-6 l-4">
                        <button type="submit" class="button add-product">Thêm vào giỏ hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT DETAIL END  -->

<!-- RELATED PRODUCTS START -->
<div class="section padding-top-0">
	<div class="line">
		<div class="margin">
			<div class="fullwidth margin-bottom-20">
				<h2 class="text-center">Sản Phẩm Tương Tự</h2>
				<hr class="break-small break-center">
			</div>
            @foreach ($relatedProduct as $product)
                <!-- product 1 -->
                <div class="s-12 m-4 l-3 margin-bottom-30">
                    <div class="margin">
                        <div class="fullwidth">
                            <figure class="imghvr-reveal-down">
                                <img src="{{ RvMedia::getImageUrl($product->image,'product-homepage', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                                <figcaption>
                                    <div class="product-hover-content">
                                        <div class="btn-box">
                                            <a href="{{ route('product.detail', ['slug' => get_category_product_by_id(get_category_by_product_id($product->id)->category_id)->slug, 'slugProduct' => $product->slug ]) }}" class="btn">Mua Ngay</a>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="fullwidth">
                            <h5>{{ $product->name }}</h5>
                            @if (!empty($product->sale_price))
                                <p class="text--product"><span class="strike">{{ number_format($product->sale_price) }} VNĐ</span> &nbsp;&nbsp; <span class="text-primary">{{ number_format($product->price) }} VNĐ</span></p>
                            @else
                                <p class="text--product"><span class="text-primary">{{ number_format($product->price) }} VNĐ</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
		</div>
	</div>
</div>
<!-- RELATED PRODUCTS END -->

<script>
    function myFunction(imgs) {
        var expandImg = document.getElementById("expandedImg");
        var imgText = document.getElementById("imgtext");
        expandImg.src = imgs.src;
        imgText.innerHTML = imgs.alt;
        expandImg.parentElement.style.display = "block";
    }
</script>
