@if ($paginator->hasPages())
<nav class="d-flex justify-content-center mt-2">
    <ul class="pagination align-items-center mb-0">

        {{-- Previous --}}
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            @if ($paginator->onFirstPage())
                <span class="page-link page-arrow">
                    <i class="bi bi-chevron-left"></i>
                </span>
            @else
                <a class="page-link page-arrow"
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev">
                    <i class="bi bi-chevron-left"></i>
                </a>
            @endif
        </li>

        {{-- Nomor Halaman --}}
        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)

                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link page-number">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link page-number"
                                href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endif

                @endforeach
            @endif

        @endforeach

        {{-- Next --}}
        <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            @if ($paginator->hasMorePages())
                <a class="page-link page-arrow"
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next">
                    <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span class="page-link page-arrow">
                    <i class="bi bi-chevron-right"></i>
                </span>
            @endif
        </li>

    </ul>
</nav>
@endif