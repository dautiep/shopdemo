@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        <a class="page gradient pagination-other-current--link">Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</a>
        @if ($paginator->onFirstPage())
            <li class="pagination-other-current disabled page gradient" aria-disabled="true"
                aria-label="@lang('pagination.previous')">
                <a class="pagination-other-current--link" href="javascript:;">
                    <i class="fas fa-chevron-left icon"> </i>
                    Prev

                </a>
            </li>
        @else
            <li class="pagination-other-current page gradient">
                <a class="pagination-other-current--link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fas fa-chevron-left icon"> Prev</i>
                </a>
            </li>
        @endif

        @php
            $start = $paginator->currentPage() - $paginator->onEachSide; // show 3 pagination links before current
            $end = $paginator->currentPage() + $paginator->onEachSide; // show 3 pagination links after current
            if ($start < 1) {
                $start = 1; // reset start to 1
                $end += 1;
            }
            if ($end >= $paginator->lastPage()) {
                $end = $paginator->lastPage();
            } // reset end to last page
        @endphp

        @if ($start > 1)
            <li class="pagination-other-current page gradient">
                <a class="pagination-other-current--link" href="{{$paginator->url(1)}}">{{ 1 }}</a>
            </li>
            @if ($paginator->currentPage() != $paginator->onEachSide + 1)
                <li class="pagination-other-current disabled page gradient" aria-disabled="true"><span>...</span></li>
            @endif
        @endif
        @for ($i = $start; $i <= $end; $i++)
            <li
                class="pagination-other-current page gradient {{$paginator->currentPage() == $i ? ' active' : '' }}">
                <a class="pagination-other-current--link" href="{{$paginator->url($i)}}">{{ $i }}</a>
            </li>
        @endfor
        @if ($end < $paginator->lastPage())
            @if ($paginator->currentPage() + $paginator->onEachSide + 1 != $paginator->lastPage())
                {{-- "Three Dots" Separator --}}
                <li class="pagination-other-current page gradient disabled" aria-disabled="true"><span>...</span></li>
            @endif
            <li class="pagination-other-current page gradient">
                <a class="pagination-other-current--link href="
                    {{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="pagination-other-current page gradient">
                <a class="pagination-other-current--link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                    aria-label="@lang('pagination.next')">Next
                    <i class="fas fa-chevron-right icon"></i>
                </a>
            </li>
        @else
            <li class="pagination-other-current page gradient disabled" aria-disabled="true"
                aria-label="@lang('pagination.next')">
                <a class="pagination-other-current--link" href="javascript:;">Next
                    <i class="fas fa-chevron-right icon"> </i>
                </a>
            </li>
        @endif
        <li class="pagination-other-current page gradient">
            <a class="pagination-other-current--link" href=" {{ $paginator->url($paginator->lastPage()) }}">Last
                <i class="fas fa-angle-double-right icon"> </i>
            </a>
        </li>
    </ul>
@endif
