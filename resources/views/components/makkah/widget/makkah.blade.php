<div class="widget ltn__author-widget">
  <div class="ltn__author-widget-inner text-center">

    <img src="{{defImagesDir('logo_dark','photo')}}" alt="Logo" class="img-fluid"/>
    <h5>{{$webConfig->name}}</h5>
    {{--        <small>Traveller/Photographer</small>--}}
    {{--        <div class="product-ratting">--}}
    {{--            <ul>--}}
    {{--                <li><a href="#"><i class="fas fa-star"></i></a></li>--}}
    {{--                <li><a href="#"><i class="fas fa-star"></i></a></li>--}}
    {{--                <li><a href="#"><i class="fas fa-star"></i></a></li>--}}
    {{--                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>--}}
    {{--                <li><a href="#"><i class="far fa-star"></i></a></li>--}}
    {{--                <li class="review-total"><a href="#"> ( 1 Reviews )</a></li>--}}
    {{--            </ul>--}}
    {{--        </div>--}}
    <p>
      {{$webConfig->footer_text}}
    </p>
    {{--    <div class="ltn__social-media">--}}
    {{--      <ul>--}}
    {{--        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>--}}
    {{--        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>--}}
    {{--        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>--}}
    {{--        <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>--}}
    {{--      </ul>--}}
    {{--    </div>--}}
  </div>

  <div class="widget_cta_btn">

    <a href="{{ctaActionCall($webConfig)}}" class="btn call_us updateFont">
      <i class="fas fa-phone-alt"></i> {{__('default/lang.cta.call')}}
    </a>
    <a href="https://wa.me/123456789" class="btn whatsapp updateFont">
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