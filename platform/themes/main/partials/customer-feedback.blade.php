<div class="customerfeedback ">
    <div class="container customerfeedback-block">
        <div class="customerfeedback__content">
            <div class="customerfeedback__content-title">
                @if (has_field($page, 'content_brand'))
                    @foreach ( get_field($page, 'content_brand') as $item )
                        <div class="customerfeedback__content-title--header ">
                         {{get_sub_field($item, 'content_top')}}
                        </div>
                        <div class="customerfeedback__content-title--listen ">
                            {{get_sub_field($item, 'content_bottom')}}
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="swiper-container customer-feedback__swiper">
                <div class="swiper-wrapper">
                    @if (has_field($page, 'img'))
                        @foreach ( get_field($page, 'img') as $item )
                                    <div class="swiper-slide">
                                        <div class="customer-feedback__item">
                                            <img src="{{RvMedia::getImageUrl(get_sub_field($item, 'img_brand'), 'img')  }}"  alt="img-here" />
                                            <h4 class="name-person"> {{get_sub_field($item, 'name_brand')}} </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="customerfeedback__content-footer ">
                @if (has_field($page, 'img_brand'))
                    <div class="customerfeedback__content-footer--content">
                        {{get_field($page, 'discription')}}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
