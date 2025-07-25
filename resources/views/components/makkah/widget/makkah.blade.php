<div class="widget ltn__author-widget makkah_widget">
  <div class="ltn__author-widget-inner_x text-center">

    <img src="{{defImagesDir('logo_dark','photo')}}" alt="Logo" class="img-fluid"/>
    <h5 class="title updateFont">{{$webConfig->name}}</h5>
    <p class="about_us updateFont">
      {{$webConfig->footer_text}}
    </p>
  </div>

  <div class="widget_cta_btn">
    <a href="{{ctaActionCall($webConfig)}}" target="_blank" class="btn call_us updateFont">
      <i class="fas  {{ctaActionCallIcon()}}"></i> {{__('default/lang.cta.call')}}
    </a>
    <a href="{{ctaActionWhatsapp($webConfig)}}" target="_blank" class="btn whatsapp updateFont">
      <i class="fab fa-whatsapp"></i> {{__('default/lang.cta.whatsapp')}}
    </a>
  </div>

</div>

<div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
  <h4 class="ltn__widget-title ltn__widget-title-border-2">Top Categories</h4>
  <ul>
    <li><a href="#">Apartments <span>(26)</span></a></li>
    <li><a href="#">Picture Stodio <span>(30)</span></a></li>
    <li><a href="#">Office <span>(71)</span></a></li>
    <li><a href="#">Luxary Vilas <span>(56)</span></a></li>
    <li><a href="#">Duplex House <span>(60)</span></a></li>
  </ul>
</div>