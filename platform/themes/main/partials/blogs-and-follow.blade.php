<!-- BLOG AND FOLLOW US START -->
<div class="section">
	<div class="line">
		<div class="margin">
			<!-- tutorial -->   
			@foreach ($newPosts as $k => $post)
                @if ($k < 2)
				<div class="s-12 m-12 l-4 margin-m-bottom-60">
					<div class="fullwidth margin-bottom">
						<a href="{{ route('blog.detail', [get_category_post_by_id(get_category_by_post_id($post->id)->category_id)->slug, $post->slug]) }}" class="image-hover-zoom">
							<img src="{{ RvMedia::getImageUrl($post->image, 'new_post', false, RvMedia::getDefaultImage()) }}" alt="">
						</a>
					</div>
					<div class="fullwidth">
						<h3>{{ $post->name }}</h3>
						<p>{{ $post->description }}</p>
					</div>
				</div>
				@endif
            @endforeach

			<!-- follow us -->
			<div class="s-12 m-12 l-4 margin-m-bottom-60">
				<div class="fullwidth margin-bottom">
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
				<div class="fullwidth">
					<h3>Follow us</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tempus quis eros ut aliquam.</p>
			    </div>
			</div>

			{{-- <!-- blog post -->
			<div class="s-12 m-12 l-4">
				<div class="fullwidth margin-bottom">
				    <a href="" class="image-hover-zoom">
					    <img src="{{ Theme::asset()->url('img/tutorial.jpg') }}" alt="">
					</a>
				</div>
				<div class="fullwidth">
					<h3>Read our blog</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tempus quis eros ut aliquam.</p>
			    </div>
			</div> --}}
		</div>
	</div>
</div>
<!-- BLOG AND FOLLOW US END -->
