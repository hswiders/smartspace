@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><a class="page-link" href="#"><i class="la la-angle-double-left"></i></a></li>
        @else
            <li class="page-item"><a class="page-link" href="javascript:;" data-page="{{ $paginator->currentPage() -1 }}" rel="prev"><i class="la la-angle-double-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item active disabled"><a class="page-link" href="javascript:;">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                       
                        <li class="page-item active"><a class="page-link" >{{ $page }}</a></li>
                    @else
                        
                        <li class="page-item"><a class="page-link" href="javascript:;" data-page="{{ $page }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="javascript:;" data-page="{{ $paginator->currentPage() +1 }}" rel="next"><i class="la la-angle-double-right"></i></a></li>
        @else
            
            <li class="page-item disabled"><a class="page-link" href="javascript:;" rel="next"><i class="la la-angle-double-right"></i></a></li>
        @endif
    </ul>
@endif