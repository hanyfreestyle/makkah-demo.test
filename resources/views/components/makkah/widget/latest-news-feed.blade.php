<div class="widget ltn__popular-post-widget">
  <h4 class="ltn__widget-title ltn__widget-title-border-2 updateFont">{{__('web/def.widget.latest_news')}}</h4>
  <ul>
    @foreach($latestNews as $news)
      <li>
        <div class="popular-post-widget-item clearfix">
          <div class="popular-post-widget-img">
            <a href="{{route('web.latest_news_view',$news->slug)}}">
              <x-web.def.img :row="$news" def-photo="news_thumbnail" def-photo-row="photo" class=""/>
            </a>
          </div>
          <div class="popular-post-widget-brief">
            <h6>
              <a href="{{route('web.latest_news_view',$news->slug)}}" class="updateFont lineCrop2">
                {{$news->name}}
              </a>
            </h6>
            <div class="ltn__blog-meta">
              <ul>
                <li class="ltn__blog-date">
                   <i class="far fa-calendar-alt"></i>{{printFormattedDate($news->created_at)}}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </li>
    @endforeach
  </ul>
</div>