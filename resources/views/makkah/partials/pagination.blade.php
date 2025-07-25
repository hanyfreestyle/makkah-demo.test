@if ($paginator->hasPages())
  <div class="ltn__pagination-area text-center">
    <div class="ltn__pagination">
      <ul>

        @if (!$paginator->onFirstPage())
          <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-angle-double-{{localizationDirSame()}}"></i></a></li>
        @endif

        @php
          $current = $paginator->currentPage();
          $last = $paginator->lastPage();
        @endphp

        {{-- الصفحة الأولى (فقط لو مش هي الحالية) --}}
        @if ($current != 1)
          <li><a href="{{ $paginator->url(1) }}">1</a></li>
        @endif

        {{-- الصفحة السابقة --}}
        @if ($current - 1 > 1)
          <li><a href="{{ $paginator->url($current - 1) }}">{{ $current - 1 }}</a></li>
        @endif

        {{-- الصفحة الحالية --}}
        <li class="active">
          <a href="{{ $paginator->url($current) }}">{{ $current }}</a>
        </li>

        {{-- الصفحة التالية --}}
        @if ($current + 1 < $last)
          <li><a href="{{ $paginator->url($current + 1) }}">{{ $current + 1 }}</a></li>
        @endif

        {{-- الصفحة الأخيرة (فقط لو مش هي الحالية أو معروضة بالفعل) --}}
        @if ($last > 1 && $current != $last)
          <li><a href="{{ $paginator->url($last) }}">{{ $last }}</a></li>
        @endif

        {{-- زر التالي --}}
        @if ($paginator->hasMorePages())
          <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-angle-double-{{localizationDirDifferent()}}"></i></a></li>
        @endif
      </ul>
    </div>
  </div>
@endif
