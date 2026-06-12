@if ($paginator->hasPages())
    <nav aria-label="Page navigation" class="d-flex justify-content-center">
        <ul class="pagination mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">
                                    {{ $page }}
                                    <span class="visually-hidden">(current)</span>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        .pagination {
            gap: 0.25rem;
            flex-wrap: wrap;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .page-item {
            display: inline-block;
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.375rem 0.75rem;
            margin-left: 0;
            line-height: 1.25;
            color: #0d6efd;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            font-size: 0.875rem;
            min-width: 2.5rem;
            text-align: center;
        }

        .page-link:hover {
            color: #0a58ca;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #e91e8c;
            border-color: #e91e8c;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dee2e6;
            opacity: 0.5;
        }
    </style>
@endif
