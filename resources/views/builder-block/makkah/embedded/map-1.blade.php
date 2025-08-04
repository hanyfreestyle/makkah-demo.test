@php
  $blockPhoto = $blockPhoto ?? asset('makkah/img/video-bg.jpg') ;

@endphp

{{--{{getData($schema,'map_url')}}--}}
<div class="map-wrapper">
  <div class="map-overlay">
    <h2>الموقع بالقرب من أبرز المناطق الحيوية</h2>
    <ul>
      <li>يبعد عن المنطقة الأولى مسافة قصيرة</li>
      <li>يقع بالقرب من المركز التجاري</li>
      <li>قريب من وسائل النقل العامة</li>
      <li>يبعد دقائق عن المدارس والمستشفيات</li>
    </ul>
    <a href="#">اضغط هنا لعرض الخريطة</a>
  </div>
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

      .map-wrapper iframe{
          z-index: 1;
      }

      .map-wrapper .map-overlay {
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          z-index: 10;
          background: rgba(0,0,0,.2);
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






