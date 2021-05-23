<!-- PAGE CONTENT START -->
<div class="section">
	<div class="line">
		<div class="margin">
			<!-- left side -->
			<div class="s-12 m-12 l-8">
			  <h1>{!! theme_option('name_about') !!}</h1>
	          <hr class="break-small">
			    <div class="fullwidth margin-bottom-60">
				  <p>{!! theme_option('content_about') !!}</p>
				</div>
                @if (has_field($page, 'noi_dung'))
                    @foreach (get_field($page, 'noi_dung') as $item)
                    <div class="fullwidth margin-bottom-60">
                        <div class="float-left">
                            <i class="{{ get_sub_field($item, 'icon') }} fa-3x text-primary"></i>
                        </div>
                        <div class="margin-left-70">
                            <h3>{{ get_sub_field($item, 'tieu_de') }}</h3>
                            <p class="text-justify">{{ get_sub_field($item, 'mo_ta') }}</p>
                        </div>
                    </div>
                    @endforeach
                @endif
			</div>
			<!-- right side -->
			<div class="s-12 m-12 l-4">
				<div class="fullwidth margin-bottom-60">
					<img src="img/about-us.jpg" alt="">
				</div>
				<div class="fullwidth">
					<h3>{!! theme_option('name_title_8') !!}</h3>
					<p class="margin-bottom">{!! theme_option('content_title_8') !!}</p>
					<div class="s-4 m-4 l-4">
					  <a href="{!! theme_option('link_FB') !!}">
						  <i class="fa fa-facebook follow-facebook"></i>
					  </a>
					</div>
					<div class="s-4 m-4 l-4">
					  <a href="{!! theme_option('link_twitter') !!}">
						  <i class="fa fa-twitter follow-twitter"></i>
					  </a>
					</div>
					<div class="s-4 m-4 l-4">
					  <a href="{!! theme_option('link_linkedin') !!}">
						  <i class="fa fa-linkedin follow-pinterest"></i>
					  </a>
					</div>
					<div class="s-4 m-4 l-4">
					  <a href="{!! theme_option('link_instagram') !!}">
						  <i class="fa fa-instagram follow-instagram"></i>
					  </a>
					</div>
					<div class="s-4 m-4 l-4">
					  <a href="{!! theme_option('link_youtobe') !!}">
						  <i class="fa fa-youtube follow-youtube"></i>
					  </a>
					</div>
					<div class="s-4 m-4 l-4">
					  <a href="{!! theme_option('link_gmail') !!}">
						  <i class="fa fa-google-plus follow-gplus"></i>
					  </a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- PAGE CONTENT END -->
