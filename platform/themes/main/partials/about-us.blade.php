<!-- ABOUT US START -->
<div class="section">
	<div class="line">
	  <!-- heading -->
	  <h2 class="text-center">{!! theme_option('name_about') !!}</h2>
	  <hr class="break-small break-center">
        @if (has_field($page, 'noi_dung'))
        <div class="margin">
            @foreach (get_field($page, 'noi_dung') as $item)
                <!-- block 1 -->
                <div class="s-12 m-6 l-4 margin-bottom-60">
                    <div class="float-left">
                        <i class="{{ get_sub_field($item, 'icon') }} fa-3x text-primary"></i>
                    </div>
                    <div class="margin-left-60">
                        <h3 class="text-uppercase">{{ get_sub_field($item, 'tieu_de') }}</h3>
                        <p class="text-justify">{{ Str::words(get_sub_field($item, 'mo_ta'), '20') }}</p>
                        <a class="text-more-info text-primary-hover" href="{{ route(get_field($page, 'duong_dan')) }}">Xem thêm</a>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
	</div>
</div>
<!-- ABOUT US END -->
