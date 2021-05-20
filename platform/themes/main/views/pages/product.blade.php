<!-- PAGE CONTENT START -->
<div class="section">
	
	<!-- page heading and description -->
	<div class="line">
	  <div class="margin">
		<div class="fullwidth margin-bottom-60">
		  <h1 class="text-center">Sản Phẩm Chăm Sóc Vẻ Đẹp Của Bạn</h1>
		  {{-- <p class="text-center">Lorem ipsum dolor sit amet, consectetur elit. Nullam molestie in massa consequat.</p> --}}
		  <hr class="break-small break-center">
		</div>
	  </div>
	</div>

	<div class="line">
		<div class="margin">
		
		  <!-- product 1 -->
		  @foreach ($product as $item )
			<div class="fullwidth margin-m-bottom-60">
				<div class="s-12 m-4 l-6 hide-s">
					<!-- hide in small screens -->
					<a class="image-hover-zoom" href="product.html"><img src="{{ RvMedia::getImageUrl($item->image, 'product', false, RvMedia::getDefaultImage()) }}" alt="" class="fullwidth border-1"></a>
				</div>
				<div class="s-12 m-8 l-6">
					<div class="item-left">
					<div class="fullwidth hide-l hide-m">
					<!-- hide in large and medium screens -->
					<a href=""><img src="{{ RvMedia::getImageUrl($item->image, 'product', false, RvMedia::getDefaultImage()) }}" alt="" class="fullwidth border-1"></a>
					</div>
					<h2>{{ $item->name }}</h2>
					<p>{{$item->description}}</p>
					<h4 class="margin-bottom-30"><span class="strike"> Trước đó :{{$item->price}} VNĐ</span><br /><span class="text-primary">Bây giờ: {{$item->sale_price}} VNĐ</span></h4>
					<a href="" class="button">Buy Now</a>
					</div>
				</div>
			</div>
			  
		  @endforeach
		  
		 
		  
		</div>
	</div>
</div>
<!-- PAGE CONTENT END -->
