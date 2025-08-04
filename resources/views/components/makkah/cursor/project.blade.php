@if(count($projectList) > 0)
  <div class="pt-70 pb-70" >
    <div class="container-fluid" id="our-project">
      @if($title)
        <div class="row">
          <div class="col-lg-12">
            <div class="pageHeading text-center">
              <h2 class="title updateFont">{{$title}}</h2>
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
                <a href="{{ printProjectSlug($project)}}">
                  <x-web.def.img :row="$project" def-photo="news_thumbnail" def-photo-row="photo" class=""/>
                </a>
              </div>
              <div class="search-by-place-info text-center">
                <h4><a class="updateFont" href="{{ printProjectSlug($project)}}">{{$project->name ?? ''}}</a></h4></div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif