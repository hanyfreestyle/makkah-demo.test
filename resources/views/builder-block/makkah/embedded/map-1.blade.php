@php
  $blockPhoto = $blockPhoto ?? asset('makkah/img/video-bg.jpg') ;

@endphp

<div class="google-map">
  <iframe src="{{getData($schema,'map_url')}}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>