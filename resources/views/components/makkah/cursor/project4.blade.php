<div class="cursorProject4" >
  <div class="ltn__slider-area ltn__slider-11  ltn__slider-11-slide-item-count-show--- ltn__slider-11-pagination-count-show--- section-bg-1">
    <div class="ltn__slider-11-inner">
      <div class="ltn__slider-11-active">
        @foreach($projectList as $project)
          <section class="project-section project-1">
            <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3-normal ltn__slide-item-3 ltn__slide-item-11">
              <div class="ltn__slide-item-inner">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12 align-self-center">
                      <div class="slide-item-info">
                        <div class="slide-item-info-inner ltn__slide-animation">


                          <h2 class="title animated updateFont">{{$project->name}}</h2>
                          <div class="des">
                            @if($project->des)
                              {!! $project->des ?? '' !!}
                            @endif
                          </div>


                          <div class="btn-wrapper animated">
                            <a href="{{ printProjectSlug($project)}}" class="theme-btn-1 btn btn-effect-1 updateFont">{{__('web/def.read_more')}}</a>


                            @if($project->video != null)
                              <a class="ltn__video-play-btn bg-white" href="https://www.youtube.com/embed/{{$project->video}}?autoplay=1&amp;showinfo=0" data-rel="lightcase">
                                <i class="fa-solid fa-play"></i>
                              </a>
                            @endif

                          </div>
                        </div>
                      </div>
                      <div class="slide-item-img">
                        <img src="{{getPhotoPath($project->photo,"photo","photo")}}" alt="#">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        @endforeach
      </div>
      <div class="ltn__slider-11-pagination-count">
        <span class="count"></span>
        <span class="total"></span>
      </div>


      <div class="ltn__slider-11-img-slide-arrow">
        <div class="ltn__slider-11-img-slide-arrow-inner">
          <div class="ltn__slider-11-img-slide-arrow-active">
            @foreach($projectList as $project)
              <div class="image-slide-item">
                <img src="{{getPhotoPath($project->photo_thumbnail,"photo","photo")}}" alt="Flower Image">
              </div>
            @endforeach
          </div>
          <div class="ltn__slider-11-slide-item-count">
            <span class="count"></span>
            <span class="total"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('stackStyle')
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/our_project_2.css',$cssMinifyType,$cssReBuild) !!}
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/builder/project_3.css',$cssMinifyType,$cssReBuild) !!}
@endpush
