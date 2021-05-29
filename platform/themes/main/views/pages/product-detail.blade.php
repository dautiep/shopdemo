
<!-- PRODUCT DETAIL START -->
<div class="section">
    <div class="line">
        <div class="margin">
            <!-- product image -->
            <div class="s-12 m-4 l-5 margin-bottom">

                    <img id="expandedImg" style="width:100%" src="{{ Theme::asset()->url('img/products/son-kem-li.jpg') }}" />
                    <!-- Close the image -->
                    <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>

                    <!-- Expanded image -->


                    <!-- Image text -->
                    <div id="imgtext"></div>

                <div class="row">
                    <div class="column">
                        <img src="{{ RvMedia::getImageUrl($product->image)  }}" alt="Nature" onclick="myFunction(this);">
                    </div>
                    <div class="column">
                        <img src="{{ RvMedia::getImageUrl($product->image)  }}" alt="Snow" onclick="myFunction(this);">
                    </div>
                    <div class="column">
                        <img src="{{ Theme::asset()->url('img/products/son-kem-li.jpg') }}" alt="Mountains" onclick="myFunction(this);">
                    </div>
                    <div class="column">
                        <img src="{{ Theme::asset()->url('img/products/son-kem-li.jpg') }}" onclick="myFunction(this);">
                    </div>
                </div>
                <!-- <img src="{{ RvMedia::getImageUrl($product->image)  }}" alt="{{ $product->name }}"> -->
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
<!-- PRODUCT DETAIL END  -->
<script>
    function myFunction(imgs) {
        var expandImg = document.getElementById("expandedImg");
        var imgText = document.getElementById("imgtext");
        expandImg.src = imgs.src;
        imgText.innerHTML = imgs.alt;
        expandImg.parentElement.style.display = "block";
    }
</script>
