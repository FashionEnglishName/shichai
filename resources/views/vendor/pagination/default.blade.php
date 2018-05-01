@if ($paginator->hasPages())
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1" style="margin-left: 21%;">
            <div class="center-block">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="disabled"><span style="width: 100px;">上一页</span></li>
                    @else
                        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><span style="width: 100px; text-align: center">上一页</span></a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="disabled"><span style="width: 100px; text-align: center">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}"><span>{{ $page }}</span></a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" style="width: 100px; text-align: center"><span>下一页</span></a></li>
                    @else
                        <li class="disabled"><span style="width: 100px; text-align: center">下一页</span></li>
                    @endif
                </ul>
            </div>
            </div>
        </div>


@endif
