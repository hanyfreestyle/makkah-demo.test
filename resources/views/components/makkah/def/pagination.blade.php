<div class="row">
  <div class="col-lg-12">
    @if($rows instanceof \Illuminate\Pagination\AbstractPaginator)
      {{ $rows->links('makkah.partials.pagination') }}
    @endif
  </div>
</div>