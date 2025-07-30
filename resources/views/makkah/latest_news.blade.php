@extends('makkah.layouts.app')

@section('content')
  {!! Breadcrumbs::render('latest_news') !!}

  <x-makkah.def.page-heading :meta="$meta"/>


  <div class="ltn__blog-area ltn__blog-item-3-normal mb-100">
    <div class="container">
      <div class="row">
        @foreach($latestNews as $news)
          <div class="col-lg-4 col-sm-6 col-12">
            <div class="ltn__blog-item ltn__blog-item-3">
              <div class="ltn__blog-img">
                <a href="{{route('web.latest_news_view',$news->slug)}}">
                  <x-web.def.img :row="$news" def-photo="news_thumbnail" def-photo-row="photo" class=""/>
                </a>
              </div>
              <div class="ltn__blog-brief">
                <div class="ltn__blog-meta">
                  <ul>
                    <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>{{printFormattedDate($news->published_at)}}</li>
                  </ul>
                </div>
                <h3 class="news_title">
                  <a href="{{route('web.latest_news_view',$news->slug)}}" class="updateFont lineCrop2">
                    {{$news->name}}
                  </a>
                </h3>
                <div class="ltn__blog-meta-btn">
                  <div class="ltn__blog-meta">
                    <ul></ul>
                  </div>
                  <div class="ltn__blog-btn"><a href="{{route('web.latest_news_view',$news->slug)}}">{{__('web/def.read_more')}}</a></div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <x-makkah.def.pagination :rows="$latestNews"/>
    </div>
  </div>

@endsection



