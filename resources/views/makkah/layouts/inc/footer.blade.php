{{--<x-makkah.cta.footer-cta :page-view="$pageView"/>--}}

<footer class="ltn__footer-area">
  <div class="footer-top-area  section-bg-2 plr--5">
    <div class="container">
      <div class="row">
        <div class="col-xl-4 col-md-6 col-sm-6 col-12">
          <div class="footer-widget footer-about-widget">
            <div class="footer-logo">
              <div class="site-logo">
                <img src="{{defImagesDir('logo_light','photo')}}" class="img-fluid"/>
              </div>
            </div>
            <p class="footer_text">{{$webConfig->footer_text}}</p>
          </div>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-6 col-12">
          <div class="footer-widget footer-about-widget">
            <div class="footer-address">
              <ul>
                <li>
                  <div class="footer-address-icon"><i class="fa-solid fa-location-dot"></i></div>
                  <div class="footer-address-info"><p><a href="{{ctaActionMap($webConfig)}}" target="_blank">{{$webConfig->schema_address}} <br>{{$webConfig->schema_city}}</a></p></div>
                </li>

                <li>
                  <div class="footer-address-icon"><i class="fa-solid fa-square-phone"></i></div>
                  <div class="footer-address-info footer_number"><p><a href="{{ctaActionCall($webConfig)}}">{{$webConfig->phone_num}}</a></p></div>
                </li>

                <li>
                  <div class="footer-address-icon"><i class="fa-brands fa-whatsapp"></i></div>
                  <div class="footer-address-info footer_number"><p><a href="#">{{$webConfig->whatsapp_num}}</a></p></div>
                </li>
                <li>
                  <div class="footer-address-icon"><i class="fa-solid fa-at"></i></div>
                  <div class="footer-address-info footer_number"><p><a href="mailto:{{$webConfig->email}}">{{$webConfig->email}}</a></p></div>
                </li>
              </ul>
            </div>

            <x-makkah.def.social-media :web-config="$webConfig"/>

          </div>
        </div>
        <div class="col-xl-2 col-md-6 col-sm-6 col-12">
          <div class="footer-widget footer-menu-widget clearfix">
            <h4 class="footer-title">{{__('web/def.footer.our_project')}}</h4>
            <div class="footer-menu">
              <ul>
                @foreach($projectMenu as $project)
                  <li><a href="{{route('web.project_view',$project->slug)}}">{{$project->name}}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-md-6 col-sm-6 col-12">
          <div class="footer-widget footer-menu-widget clearfix">
            <h4 class="footer-title">{{__('web/def.footer.main_menu')}}</h4>
            <div class="footer-menu">
              <ul>
                <li><a href="{{route('web.index')}}">{{__('web/def.menu.home')}}</a></li>
                <li><a href="{{route('web.about_us')}}">{{__('web/def.menu.about_us')}}</a></li>
                <li><a href="{{route('web.latest_news')}}">{{__('web/def.menu.latest_news')}}</a></li>
                <li><a href="{{route('web.contact_us')}}">{{__('web/def.menu.contact_us')}}</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ltn__copyright-area ltn__copyright-2 section-bg-7  plr--5">
    <div class="container ltn__border-top-2">
      <div class="row">
        <div class="col-md-12 col-12 text-center">
          <div class="ltn__copyright-design clearfix">
            <p>{!! getCopyRight('2008',$webConfig->name ) !!}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>