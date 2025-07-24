<div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
  <div class="ltn__utilize-menu-inner ltn__scrollbar">
    <div class="ltn__utilize-menu-head">
      <div class="site-logo">
        <a href="{{route('web.index')}}">
          <img src="{{defImagesDir('logo_dark','photo')}}" class="img-fluid"/>
        </a>
      </div>
      <button class="ltn__utilize-close">×</button>
    </div>
    <div class="ltn__utilize-menu">
      <ul>
        <li><a href="{{route('web.index')}}">{{__('web/def.menu.home')}}</a></li>
        <li><a href="{{route('web.about_us')}}">{{__('web/def.menu.about_us')}}</a></li>
        <li><a href="#">{{__('web/def.menu.our_project')}}</a>
          <ul class="sub-menu">
            <li><a href="#">Rowaq Sheikh Zayed</a></li>
            <li><a href="#">October Projects</a></li>
            <li><a href="#">Alexadria Projects</a></li>
          </ul>
        </li>
        <li><a href="{{route('web.latest_news')}}">{{__('web/def.menu.latest_news')}}</a></li>
        <li><a href="{{route('web.contact_us')}}">{{__('web/def.menu.contact_us')}}</a></li>
        @if($webConfig->switch_lang)
          <li>
            <a class="changeLanguage" href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(),$pageView['slug'], [], true) }}">
              {{__('web/def.change_language')}}
            </a>
          </li>
        @endif
      </ul>
    </div>
    <x-makkah.def.social-media type="mobile" :web-config="$webConfig"/>
  </div>
</div>
<div class="ltn__utilize-overlay"></div>