@php
  $blockPhoto = $blockPhoto ?? asset('makkah/img/video-bg.jpg') ;

@endphp

<div class="ltn__video-popup-area ltn__video-popup-margin mt-50">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="ltn__video-bg-img ltn__video-popup-height-600 bg-overlay-black-10-- bg-image" data-bs-bg="{{ $blockPhoto }}">
          <a class="ltn__video-icon-2 ltn__video-icon-2-border border-radius-no ltn__secondary-bg"
             href="https://www.youtube.com/embed/{{getData($schema,'video_code')}}?autoplay=1&amp;showinfo=0" data-rel="lightcase:myCollection">
            <i class="fa fa-play"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="ltn__brand-logo-area ltn__brand-logo-1 bg-image bg-overlay-theme-black-90 pt-290 pb-10 plr--9" data-bs-bg="{{ $blockPhoto }}">
  {{--  <div class="container-fluid">--}}
  {{--     --}}
  {{--  </div>--}}
</div>