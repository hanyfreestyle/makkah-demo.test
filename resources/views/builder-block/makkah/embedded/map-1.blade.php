@php
  $blockPhoto = $blockPhoto ?? asset('makkah/img/video-bg.jpg') ;

@endphp

{{--{{getData($schema,'map_url')}}--}}
<div class="google-map map-wrapper">
  <div class="map-overlay"></div>
  <iframe src="{{getData($schema,'map_url')}}&hl=en" width="100%" height="100%" style="border:0;" allowfullscreen=""  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

{{--<div class="google-map">--}}
{{--  <iframe src="https://www.google.com/maps/d/embed?mid=13GfEtuSGnSzGtzDyT3LK7pKB_42F6bo&ehbc=2E312F" width="640" height="480"></iframe>--}}
{{--</div>--}}


@push('stackStyle')
  <style>
      .map-wrapper {
          position: relative;
          width: 100%;
          height: 75vh;
      }

      .map-wrapper .map-overlay {
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          /*background: transparent;*/
          z-index: 10;
          /*background: yellow!important;*/
          /* يمنع أي interaction مع الماوس */
      }

      .map-wrapper iframe {
          width: 100%;
          height: 100%;
          border: 0;
      }
  </style>
@endpush


@push('stackScript')
  <script>
      document.querySelector('.map-overlay').addEventListener('click', function () {
          this.style.pointerEvents = 'none'; // يزيل الحاجز ويسمح بالتفاعل
      });
  </script>

@endpush






