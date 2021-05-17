<ul class="right chevron">
    @foreach ($menu_nodes as $menu)
        @if ($menu->has_child)
            <li>
                <a class="hvr-sweep-to-bottom" href="href="{{$menu->url}}">{{ $menu->title }}</a>
                @if(count($menu->child)>0)
                    <ul>
                        @foreach ($menu->child as $menu_sub)
                             <li><a href="{{$menu_sub->url}}" class="hvr-sweep-to-bottom">{{$menu_sub->title}}</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @else
            <li>
                <a class="hvr-sweep-to-bottom" href="{{$menu->url}}">{{ $menu->title }}</a>
            </li>
        @endif
    @endforeach
    {{-- <li><a href="{{ route('public.get-product') }}" class="hvr-sweep-to-bottom">Sản phẩm</a>
        <ul>
            <li>
                <a href="{{ route('public.get-product-detail') }}" class="hvr-sweep-to-bottom">Product-Detail
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a class="hvr-sweep-to-bottom">Design One</a>
        <ul>
            <li><a href="{{ route('public.about-us') }}" class="hvr-sweep-to-bottom">About
                    Us</a></li>
            <li><a href="{{ route('public.get-contact') }}" class="hvr-sweep-to-bottom">Contact
                    Us</a></li>
            <li><a href="{{ route('public.get-product') }}" class="hvr-sweep-to-bottom">Products
                    Category</a></li>
            <li><a href="{{ route('public.get-product-detail') }}"
                    class="hvr-sweep-to-bottom">Product Detail</a></li>
            <li><a href="{{ route('public.get-cart') }}" class="hvr-sweep-to-bottom">Cart</a>
            </li>
            <li><a href="{{ route('public.blog') }}" class="hvr-sweep-to-bottom">Blog</a></li>
            <li><a href="{{ route('public.blog-post') }}" class="hvr-sweep-to-bottom">Blog
                    Post</a></li>
            <li><a href="{{ route('public.get-cart') }}" class="hvr-sweep-to-bottom">Page Not
                    Found</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="" class="hvr-sweep-to-bottom">Liên hệ</a>
    </li> --}}
</ul>
{{-- @foreach ($menu_nodes as $menu)
    @if ($menu->has_child)
    <li class="sub-menu first"><a class="sub_menu-item" title="" href="{{$menu->url}}" >{{ $menu->title }}</a>
        <!-- MEGA MENU -->
        @if(count($menu->child)>0)
        <ul class="mega_menu megamenu_col1 clearfix">
            <li class="col">
                <ol>
                    @foreach ($menu->child as $menu_sub)
                    <li><a href="javascript:void(0);" >{{$menu_sub->title}}</a></li>
                    @endforeach
                </ol>
            </li>
        </ul><!-- //MEGA MENU -->
        @endif
    </li> --}}
