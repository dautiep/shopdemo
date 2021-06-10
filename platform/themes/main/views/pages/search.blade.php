@section('content')
<div class="container" style="display:block;">
    <div class="search-page">
        <div class="search-page_header">
            <h1 class="search-page_header__title">Tìm kiếm</h1>
        </div>
    <div class="result_search">{{__("Hiển thị")}} {{count($result)}}  {{__("kết quả")}} {{__("trong")}} {{$time}}  {{__("giây")}}</div>
        <form action="">
            <div class="form-inline search__content">
                <div class="form-group search__content_form">
                <input type="text" name="q" class="form-control search__input" value="{{$key}}">
                </div>
                <div class="form-group">
                    <input type="submit" value="{{__("Tìm kiếm")}}" class="search__button">
                </div>
            </div>
        </form>
        <div class="result_content_search">
            <!-- Pagination pane -->
                {{-- <div class="text-center">
                    {{ $posts->onEachSide(1)->links('theme.main::partials.pagination') }}
                </div> --}}
            @forelse($result as $k => $item)
                <dl class="result_content_search_list" style="margin-top: 20px;">
                    <dd class="search_item">
                        <div class="search_item_des">
                            <h3>
                            <a class="search_item_des__link" href="{{ route('blog.detail', [get_category_post_by_id(get_category_by_post_id($item->id)->category_id)->slug, $item->slug]) }}" target="_blank" title="{{ $item->name }}">{{ $item->name }}</a>
                            </h3>
                            <div class="search_item_des__content">
                                {{$item->description}}
                            </div>
                            <hr style="margin-top: 20px;">
                        </div>
                    </dd>
                </dl>
            @empty
            <p  class="text-danger">{{__("Không thấy kết quả tìm kiếm !")}}</p>
            @endforelse

        </div>
    </div>
</div>
