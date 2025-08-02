
<div class="container mt-50">
  <div class="masonry bordered  gutterlessX">

    @foreach($block->photos as $photo)
      {{--    <div class="col-lg-12">--}}
      {{--      <div class="ltn__img-slide-item-4">--}}
      {{--        <a href="{{ Storage::disk('root_folder')->url($photo->photo)}}" data-rel="lightcase:myCollection">--}}
      {{--          <img src="{{ Storage::disk('root_folder')->url($photo->photo_thumbnail)}}" alt="Image">--}}
      {{--        </a>--}}
      {{--      </div>--}}
      {{--    </div>--}}

      <div class="brick gallery_item">
        <img src="{{ Storage::disk('root_folder')->url($photo->photo_thumbnail)}}" alt="Cherry plant" title="Cherry plant">
        <div class="overlay">
          <div class="title">منظر طبيعي جميل</div>
          <div class="zoom-icon">
            <i class="fas fa-search-plus"></i>
          </div>
        </div>
      </div>

    @endforeach




  </div>
</div>




@push('stackStyle')
{{--  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/masonry/labs.css',$cssMinifyType,$cssReBuild) !!}--}}
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/masonry/masonry.css',$cssMinifyType,$cssReBuild) !!}
@endpush


@push('stackScript')

@endpush
