<!-- SLIDESHOW START -->
<div class="carousel-fade-transition owl-carousel carousel-main">
	<!-- slide 1 -->
	<div class="item">
	    <!-- slideshow photo -->
        @if (has_field($page, 'banner'))
            <div class="image-box">
                <div class="image">
                    <img class="img-slider" src="{{RvMedia::getImageUrl(get_field($page, 'banner'), 'slides')  }}" alt="">
                </div>
            </div>
        @endif
		<!-- slideshow content -->
		{{-- <div class="carousel-content">
			<div class="content-center-vertical line">
				<div class="s-12 m-8 l-7">
                    @if (has_field($page, 'slide_text'))
                        @foreach ( get_field($page, 'slide_text') as $item )
                            <h1 class="margin-bottom-10 animated-carousel-element">{{get_sub_field($item, 'text_top')}}</h1>
                            <p class="margin-bottom-30 animated-carousel-element slow">{{get_sub_field($item, 'text_bottom')}}</p>
                        @endforeach
                    @endif
					<div class="animated-carousel-element">
                        @if (has_field($page, 'button'))
                            @foreach ( get_field($page, 'button') as $item )
                                <a href="" class="slideshow-btn">{{get_sub_field($item, 'button_1')}}</a>
                                <a href="" class="slideshow-btn2">{{get_sub_field($item, 'button_2')}}</a>
                            @endforeach
                        @endif
					</div>
				</div>
			</div>
		</div> --}}
	</div>

	<!-- slide 2 -->
    <div class="item">
	    <!-- slideshow photo -->
        @if (has_field($page, 'banner_2'))
            <div class="image-box">
                <div class="image">
                    <img class="img-slider" src="{{RvMedia::getImageUrl(get_field($page, 'banner_2'), 'slides')  }}" alt="">
                </div>
            </div>
        @endif
		<!-- slideshow content -->
		{{-- <div class="carousel-content">
			<div class="content-center-vertical line">
				<div class="s-12 m-8 l-7">
                    @if (has_field($page, 'slide_text_2'))
                        @foreach ( get_field($page, 'slide_text_2') as $item )
                            <h1 class="margin-bottom-10 animated-carousel-element">{{get_sub_field($item, 'text_top_2')}}</h1>
                            <p class="margin-bottom-30 animated-carousel-element slow">{{get_sub_field($item, 'text_bottom_2')}}</p>
                        @endforeach
                    @endif
					<div class="animated-carousel-element">
                        @if (has_field($page, 'button_2'))
                            @foreach ( get_field($page, 'button_2') as $item )
                                <a href="" class="slideshow-btn">{{get_sub_field($item, 'button_one')}}</a>
                                <a href="" class="slideshow-btn2">{{get_sub_field($item, 'button_two')}}</a>
                            @endforeach
                        @endif
					</div>
				</div>
			</div>
		</div> --}}
	</div>
</div>
<!-- SLIDESHOW END -->
