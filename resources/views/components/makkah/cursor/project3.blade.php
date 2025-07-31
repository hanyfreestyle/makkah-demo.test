@if(count($projectList) > 0)
  <div class="ltn__upcoming-project-area cursorProject3 section-bg-1--- bg-image-top pt-70 pb-65" data-bs-bg="{{$defPhoto}}">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title-area ltn__section-title-2--- text-center---">
            @if($title)
              <h2 class="sectionTitle  white-color updateFont">{{$title}}</h2>
              @if($des)
                <p class="sectionDes">{{$des}}</p>
              @endif
            @endif
          </div>
        </div>
      </div>
      <div class="row ltn__upcoming-project-slider-1-active slick-arrow-3">
        @foreach($projectList as $project)
          <section class="project-section project-1">
            <div class="col-lg-12">
              <div class="ltn__upcoming-project-item">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="ltn__upcoming-project-img">
                      <img src="{{getPhotoPath($project->photo_thumbnail,"photo","photo")}}" alt="#">
                    </div>
                  </div>
                  <div class="col-lg-6 ">
                    <div class="ltn__upcoming-project-info ltn__menu-widget">
                      <h3 class="project-title updateFont">{{$project->name}}</h3>
                      @if($project->des)
                        {!! $project->des ?? '' !!}
                      @endif

                      <div class="btn-wrapper animated mt-40 {{ textDir() }}">
                        <a href="{{ route('web.project_view',$project->slug) }}" class="theme-btn-1 btn btn-effect-1 updateFont">{{__('web/def.read_more')}}</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        @endforeach


      </div>
    </div>
  </div>

@endif

@push('stackStyle')
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/our_project_2.css',$cssMinifyType,$cssReBuild) !!}
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/builder/project_3.css',$cssMinifyType,$cssReBuild) !!}
@endpush