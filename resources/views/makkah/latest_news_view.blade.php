@extends('makkah.layouts.app')

@section('content')
  {!! Breadcrumbs::render('latest_news_view',$news) !!}

  <div class="ltn__page-details-area ltn__blog-details-area  mb-120">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="ltn__blog-details-wrap blogDetails_wrap">
            <div class="ltn__page-details-inner ltn__blog-details-inner">
              <h1 class="ltn__blog-title">{{$news->name}}</h1>

              <div class="ltn__blog-meta blog_meta_date">
                <ul>
                  <li class="ltn__blog-date ">
                    <i class="far fa-calendar-alt"></i>{{printFormattedDate($news->created_at)}}
                  </li>
                </ul>
              </div>
              <div class="blogPhoto">
                <x-web.def.img :row="$news" row-name="photo" def-photo="news_thumbnail" def-photo-row="photo" class=""/>
              </div>
              <div class="newsDesPrint mt-20">
                {!! $news->des !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <aside class="sidebar-area blog-sidebar ltn__right-sidebar blogSideBar">
            {{--            <x-makkah.widget.latest-news-feed/>--}}
            <x-makkah.widget.makkah/>
            <x-makkah.widget.form/>

            <div class="widget ltn__social-media-widget">
              <h4 class="ltn__widget-title ltn__widget-title-border-2">Follow us</h4>
              <div class="ltn__social-media-2">
                <ul>
                  <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                  <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                </ul>
              </div>

              <div class="widget_cta_btn">

{{--                <a href="tel:+123456789" class="btn call_us updateFont">--}}
{{--                  <i class="fas fa-phone-alt"></i> {{__('default/lang.cta.call')}}--}}
{{--                </a>--}}
                <a href="https://wa.me/123456789" class="btn whatsapp updateFont">
                  <i class="fab fa-whatsapp"></i>  {{__('default/lang.cta.whatsapp')}}
                </a>
                    <a href="https://wa.me/123456789" class="btn map updateFont">
                      <i class="fas fa-map"></i>  {{__('default/lang.cta.map')}}
                    </a>
              </div>

            </div>


          </aside>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('stackStyle')
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/blog.css',$cssMinifyType,$cssReBuild) !!}
@endpush




