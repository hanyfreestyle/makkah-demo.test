@if(count($projectList) > 0)
  <div class="ltn__search-by-place-area section-bg-1 before-bg-top--- bg-image-top--- pt-115 pb-70" data-bs-bg="img/bg/20.jpg">
    <div class="container-fluid" id="our-project">
      @if($title)
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title-area ltn__section-title-2--- text-center">
              <h1 class="section-title">{{$title}}</h1>
              @if($des)
                <p>{{$des}}</p>
              @endif
            </div>
          </div>
        </div>
      @endif
      <div class="row ltn__search-by-place-slider-1-active slick-arrow-1">
        @foreach($projectList as $project)
          <div class="col-lg-4">
            <div class="ltn__search-by-place-item">
              <div class="search-by-place-img">
                <a href="{{ route('web.project_view',$project->slug) }}">
                  <x-web.def.img :row="$project" def-photo="news_thumbnail" def-photo-row="photo" class=""/>
                </a>
              </div>
              <div class="search-by-place-info text-center">
                <h4><a class="updateFont" href="{{ route('web.project_view',$project->slug) }}">{{$project->name ?? ''}}</a></h4></div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif