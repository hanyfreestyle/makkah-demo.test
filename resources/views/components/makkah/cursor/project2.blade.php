@if(count($projectList) > 0)
  <div class="container-fluid pt-40" id="our-project">
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
  </div>
  <div class="ltn__slider-areaX ltn__slider-3X  section-bg-2">
    <div class="ltn__slide-one-active slick-slide-arrow-1 slick-slide-dots-1">

      @foreach($projectList as $project)

        <div class="sliderArea_2 ltn__slide-item-3-normal--- ltn__slide-item-3 bg-image bg-overlay-theme-black-60" data-bs-bg="{{getPhotoPath($project->photo,"photo","photo")}}">
          {{--        <div class="ltn__slide-item ltn__slide-item-2 sliderArea_2 ltn__slide-item-3-normal--- ltn__slide-item-3 bg-image bg-overlay-theme-black-60" data-bs-bg="{{getPhotoPath($project->photo,"photo","photo")}}">--}}
          <div class="ltn__slide-item-inner text-center">
            <div class="container">
              <div class="row">
                <div class="col-lg-12 align-self-center">
                  <div class="slide-item-info">
                    <div class="slide-item-info-inner ltn__slide-animation">
                      @if($project->video != null)
                        <div class="slide-video mb-50">
                          <a class="ltn__video-icon-2 ltn__video-icon-2-border" href="https://www.youtube.com/embed/{{$project->video}}" data-rel="lightcase:myCollection">
                            <i class="fa fa-play"></i>
                          </a>
                        </div>
                      @endif


                      <h1 class="slide-title animated updateFont">{{$project->name ?? ''}}</h1>
                      @if($project->short)
                        <div class="slide-brief animated">
                          <p>{{$project->short ?? ''}}</p>
                        </div>
                      @endif

                      <div class="btn-wrapper animated">
                        <a href="{{ route('web.project_view',$project->slug) }}" class="theme-btn-1 btn btn-effect-1 updateFont">{{__('web/def.read_more')}}</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif
