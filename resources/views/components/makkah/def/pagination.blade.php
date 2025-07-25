<div class="container pagination_div">
    <div class="d-flex justify-content-center">
        @if($rows instanceof \Illuminate\Pagination\AbstractPaginator)
            {{ $rows->links('makkah.partials.pagination') }}
        @endif
    </div>
</div>