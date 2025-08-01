<div class="projectHero">
  <div class="ltn__slider-area ltn__slider-3 section-bg-2">
    <div class="ltn__slide-one-active slick-slide-arrow-1 slick-slide-dots-1">
      <div class="ltn__slide-item ltn__slide-item-2X ltn__slide-item-3-normal--- ltn__slide-item-3 bg-image bg-overlay-theme-black-60X" data-bs-bg="{{$blockPhoto}}">
        <div class="ltn__slide-item-inner text-center">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 align-self-center">
                <div class="slide-item-info">
                  <div class="slide-item-info-inner ltn__slide-animation">


                    <h1 class="slide-title slideTitle animated updateFont">
                      {{getLangData($schema, 'h1')}}
                    </h1>

                    @if(getLangData($schema, 'des'))
                      <div class="slide-brief slideBrief animated">
                        <p class="updateFont">
                          {{getLangData($schema, 'des')}}
                        </p>
                      </div>
                    @endif

                    @if(getLangData($schema, 'btn'))
                      <div class="btn-wrapper animated ">
                        <a href=" {{getLangData($schema, 'btn_url')}}" class="theme-btn-1 btn btn-effect-1 updateFont">
                          {{getLangData($schema, 'btn')}}
                        </a>
                      </div>
                    @endif

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
