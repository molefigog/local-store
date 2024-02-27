@if ($paginator->hasPages())
    <?php
    $items_count = 6;
    $show_first_item = false;
    $show_last_item = false;
    
    $limit_start = 1;
    $limit_end = 1;
    if (count($elements[0]) > $items_count * 2) {
        $limit_start = $paginator->currentPage() - 1;
        $limit_end = $limit_start + 2;
    }
    
    if ($paginator->currentPage() >= $items_count) {
        $show_first_item = true;
    }
    if ($paginator->lastPage() > $paginator->currentPage() + 1) {
        $show_last_item = true;
    }
    ?>


       

        <ul class="pagination justify-content-center">
            @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">&laquo;</a>
         @endif
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span class="">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($show_first_item and $page == 1)
                            <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                            @if ($paginator->currentPage() != 6)
                                <li class="disabled"><a class="">...</a></li>
                            @endif
                        @endif

                        @if ($page >= $limit_start and $page <= $limit_end)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><a href=""><span class="">{{ $page }}</span></a>
                                </li>
                            @else
                                <li class=""><a class="" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endif

                        @if ($show_last_item and $page == $paginator->lastPage())
                            @if ($paginator->currentPage() != $paginator->lastPage() - 2)
                                <li class="disabled"><a class="">...</a></li>
                            @endif
                            <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @endif
        </ul>
