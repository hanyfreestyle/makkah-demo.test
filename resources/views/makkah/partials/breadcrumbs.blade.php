@unless ($breadcrumbs->isEmpty())
  <div class="breadcrumb_area text-left" id="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_list">
            <ul>
              @foreach ($breadcrumbs as $breadcrumb)
                @if (!is_null($breadcrumb->url) && !$loop->last)
                  <li class="breadcrumb-slide" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{!! $breadcrumb->url !!}" aria-label="{{$breadcrumb->title}}">
                      @if($loop->index == 0)
                        <span class="ltn__secondary-color"><i class="fas fa-home"></i></span>
                      @endif
                      <span itemprop="name">
                        {!! $breadcrumb->title !!}
                    </span>
                    </a>
                    <meta itemprop="position" content=" {{$loop->index+1}}"/>
                  </li>
                @else
                  <li class="breadcrumb-slide " itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                     <span itemprop="item" href="{!! $breadcrumb->url !!}" aria-label="{{$breadcrumb->title}}">
                         <span class="current" itemprop="name">{!! $breadcrumb->title !!}</span>
                     </span>
                    <meta itemprop="position" content=" {{$loop->index+1}}"/>
                  </li>
                @endif
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endunless

