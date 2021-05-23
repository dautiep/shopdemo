<!-- PRODUCT DETAIL START -->
<div class="section">
    <div class="line">
        <div class="margin">
            <!-- product image -->
            <div class="s-12 m-4 l-5 margin-bottom">
                <img src="{{ RvMedia::getImageUrl($product->image)  }}" alt="{{ $product->name }}">
            </div>
            <!-- product detail -->
            <div class="s-12 m-8 l-7 padding-l-left">
                <h2 class="text-primary product-name">{{ $product->name }}</h2>
                <p class="text-justify">
                    {!! $product->description !!}
                </p>

                <div class="fullwidth margin-bottom-40">
                    <div class="numbers-row">
                        <label>Số lượng:</label>
                        <input type="number" name="quanity" class="quantity" id="french-hens" value="1">
                    </div>
                </div>
                <div class="s-12 m-6 l-4">
                    <a href="" class="button">Thêm vào giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT DETAIL END -->
