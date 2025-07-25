@if(count($latestNews) >0 )
  <div class="ltn__blog-area pt-120 pb-70">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title-area ltn__section-title-2--- text-center">
            <h2 class="section-title">Leatest News Feeds</h2>
          </div>
        </div>
      </div>
      <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
        @foreach($latestNews as $news)
          <div class="col-lg-12">
            <div class="ltn__blog-item ltn__blog-item-3">
              <div class="ltn__blog-img">
                <a href="{{route('web.latest_news_view',$news->slug)}}">
                  <x-web.def.img :row="$news" def-photo="news_thumbnail" def-photo-row="photo" class=""/>
                </a>
              </div>
              <div class="ltn__blog-brief">
                <div class="ltn__blog-meta">
                  <ul>
                    <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>{{printFormattedDate($news->created_at)}}</li>
                  </ul>
                </div>
                <h3 class="news_title">
                  <a href="{{route('web.latest_news_view',$news->slug)}}" class="updateFont lineCrop2">
                    {{$news->name}}
                  </a>
                </h3>
                <div class="ltn__blog-meta-btn">
                  <div class="ltn__blog-meta">
                    <ul>

                    </ul>
                  </div>
                  <div class="ltn__blog-btn"><a href="{{route('web.latest_news_view',$news->slug)}}">{{__('web/def.read_more')}}</a></div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif