<header class="ltn__header-area ltn__header-5 ltn__header-logo-and-mobile-menu-in-mobile ltn__header-logo-and-mobile-menu ltn__header-transparent gradient-color-4---">
  <div class="ltn__header-top-area top-area-color-white d-none d-md-block">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div class="ltn__top-bar-menu">
            <ul>
              <li><a href="{{ctaActionMap($webConfig)}}" target="_blank"><i class="fa-solid fa-location-dot"></i> {{$webConfig->schema_address}} ,{{$webConfig->schema_city}}</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-5">
          <div class="top-bar-right {{textDir()}}">
            <div class="ltn__top-bar-menu">
              <ul>
                @if($webConfig->switch_lang)
                  <li>
                    <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                      <ul>
                        <li>
                          <a href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(),$pageView['go_home']) }}">
                            <span class="active-currency changeLanguage">{{__('web/def.change_language')}}</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                @endif
                <li>
                  <x-makkah.def.social-media type="header" :web-config="$webConfig"/>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ltn__header-middle-area ltn__header-sticky ltn__sticky-bg-black">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="site-logo-wrap">
            <div class="site-logo edit_logo">
              <a href="{{route('web.index')}}">
                <img src="{{defImagesDir('logo_light','photo')}}" alt="Logo" class="img-fluid"/>
              </a>
            </div>
          </div>
        </div>
        <div class="col header-menu-column menu-color-white">
          <div class="header-menu d-none d-xl-block">
            <nav>
              <div class="ltn__main-menu">
                <ul>
                  <li><a href="{{route('web.index')}}">{{__('web/def.menu.home')}}</a></li>
                  <li><a href="{{route('web.about_us')}}">{{__('web/def.menu.about_us')}}</a></li>
                  <li><a href="#">{{__('web/def.menu.our_project')}}</a>
                    <ul>
                      @foreach($projectMenu as $project)
                        <li><a href="{{route('web.project_view',$project->slug)}}">{{$project->name}}</a></li>
                      @endforeach
                    </ul>
                  </li>
                  <li><a href="{{route('web.latest_news')}}">{{__('web/def.menu.latest_news')}}</a></li>
                  <li><a href="{{route('web.contact_us')}}">{{__('web/def.menu.contact_us')}}</a></li>
                  <li class="special-link cta_number"><a href="{{ctaActionCall($webConfig)}}">{{$webConfig->phone_num}} </a></li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
        <div class="col--- ltn__header-options ltn__header-options-2 ">
          <div class="mobile-menu-toggle d-xl-none"><a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
              <svg viewBox="0 0 800 600">
                <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                <path d="M300,320 L540,320" id="middle"></path>
                <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
              </svg>
            </a></div>
        </div>
      </div>
    </div>
  </div>
</header>
@include('makkah.layouts.inc.header_menu_mobile')