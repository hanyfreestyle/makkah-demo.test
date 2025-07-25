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
            <x-makkah.widget.latest-news-feed/>
            <x-makkah.widget.makkah/>
            <x-makkah.widget.form/>
            <x-makkah.widget.follow-us/>


          </aside>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('stackStyle')
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/blog.css',$cssMinifyType,$cssReBuild) !!}
@endpush




