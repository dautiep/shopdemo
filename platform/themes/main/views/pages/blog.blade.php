<!-- PAGE CONTENT START -->
<div class="section">

    <!-- page heading and description -->
    <div class="line">
        <div class="margin">
            <div class="fullwidth margin-bottom-60">
                @if (!empty($category))
                    <h1 class="text-center">{{ $category->name }}</h1>
                @else
                    <h1 class="text-center">Tin tức</h1>
                @endif
                <p class="text-center">Nơi cập nhật những tin tức mới nhất về mỹ phẩm, làm đẹp
                </p>
                <hr class="break-small break-center">
            </div>
        </div>
    </div>

    <div class="line">
        <div class="margin">
            @foreach ($posts as $k => $post)
                @if ($k % 2 == 0)
                    <!-- blog post 1 -->
                    <div class="fullwidth margin-m-bottom-60">
                        <div class="s-12 m-4 l-6 hide-s">
                            <!-- hide in small screens -->
                            <a class="image-hover-zoom" href="{{ route('blog.detail', [get_category_post_by_id(get_category_by_post_id($post->id)->category_id)->slug, $post->slug]) }}"><img src="{{ RvMedia::getImageUrl($post->image) }}" alt="{{ $post->name }}" class="fullwidth"></a>
                        </div>
                        <div class="s-12 m-8 l-6">
                            <div class="item-left">
                                <div class="fullwidth hide-l hide-m">
                                    <!-- hide in large and medium screens -->
                                    <a href="{{ route('blog.detail', [get_category_post_by_id(get_category_by_post_id($post->id)->category_id)->slug, $post->slug]) }}"><img src="{{ Theme::asset()->url('img/blog/1.jpg') }}" alt="" class="fullwidth"></a>
                                </div>
                                <h3 class="text-primary">{{ $post->name }}</h3>
                                <p class="margin-bottom-30">{{ Str::words($post->description, '40') }}</p>
                                <a href="{{ route('blog.detail', [get_category_post_by_id(get_category_by_post_id($post->id)->category_id)->slug, $post->slug]) }}" class="button">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- blog post 2 -->
                    <div class="fullwidth margin-m-bottom-60">
                        <div class="s-12 m-8 l-6">
                            <div class="item-right">
                                <div class="fullwidth hide-l hide-m">
                                    <!-- hide in large and medium screens -->
                                    <a href="{{ route('blog.detail', [get_category_post_by_id(get_category_by_post_id($post->id)->category_id)->slug, $post->slug]) }}"><img src="{{ RvMedia::getImageUrl($post->image) }}" alt="" class="fullwidth"></a>
                                </div>
                                <h3 class="text-primary">{{ $post->name }}</h3>
                                <p class="margin-bottom-30">{{ Str::words($post->description, '40') }}</p>
                                <a href="{{ route('blog.detail', [get_category_post_by_id(get_category_by_post_id($post->id)->category_id)->slug, $post->slug]) }}" class="button">Xem thêm</a>
                            </div>
                        </div>
                        <div class="s-12 m-4 l-6 hide-s">
                            <!-- hide in small screens -->
                            <a class="image-hover-zoom" href="{{ route('blog.detail', [get_category_post_by_id(get_category_by_post_id($post->id)->category_id)->slug, $post->slug]) }}"><img src="{{ RvMedia::getImageUrl($post->image) }}" alt="" class="fullwidth"></a>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
        <div class="detail-pagination">
            {{ $posts->links('theme.main::partials.pagination') }}
        </div>
    </div>
</div>
<!-- PAGE CONTENT END -->
