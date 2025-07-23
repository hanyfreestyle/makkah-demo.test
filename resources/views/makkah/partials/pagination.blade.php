@if ($paginator->hasPages())
    <div class="pagination">

        {{-- زر السابق --}}
        @if ($paginator->onFirstPage())
            <div class="pagination-item disabled">
                <i class="fas fa-chevron-left"></i>
            </div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-item page-link p-0 d-grid" rel="prev" aria-label="Previous">
                @if(app()->getLocale() == 'ar')
                    <i class="fa-solid fa-angles-right"></i>
                @else
                    <i class="fa-solid fa-angles-left"></i>
                @endif
            </a>
        @endif

        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
        @endphp

        {{-- الصفحة الأولى (فقط لو مش هي الحالية) --}}
        @if ($current != 1)
            <a href="{{ $paginator->url(1) }}" class="pagination-item page-link p-0 d-grid">1</a>
        @endif

        {{-- الصفحة السابقة --}}
        @if ($current - 1 > 1)
            <a href="{{ $paginator->url($current - 1) }}" class="pagination-item page-link p-0 d-grid">{{ $current - 1 }}</a>
        @endif

        {{-- الصفحة الحالية --}}
        <div class="pagination-item active">
            <span class="page-link d-grid page-link_active" aria-current="page">{{ $current }}</span>
        </div>

        {{-- الصفحة التالية --}}
        @if ($current + 1 < $last)
            <a href="{{ $paginator->url($current + 1) }}" class="pagination-item page-link p-0 d-grid">{{ $current + 1 }}</a>
        @endif

        {{-- الصفحة الأخيرة (فقط لو مش هي الحالية أو معروضة بالفعل) --}}
        @if ($last > 1 && $current != $last)
            <a href="{{ $paginator->url($last) }}" class="pagination-item page-link p-0 d-grid">{{ $last }}</a>
        @endif

        {{-- زر التالي --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-item page-link d-grid" rel="next" aria-label="Next">
                @if(app()->getLocale() == 'ar')
                    <i class="fa-solid fa-angles-left"></i>
                @else
                    <i class="fa-solid fa-angles-right"></i>
                @endif
            </a>
        @else
            <div class="pagination-item disabled"><span>»</span></div>
        @endif

    </div>
@endif
