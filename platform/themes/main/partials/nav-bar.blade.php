<ul class="right chevron">
    @foreach ($menu_nodes as $menu)
        @if ($menu->has_child)
            <li>
                <a class="hvr-sweep-to-bottom" href="{{$menu->url}}">{{ $menu->title }}</a>
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
</ul>

