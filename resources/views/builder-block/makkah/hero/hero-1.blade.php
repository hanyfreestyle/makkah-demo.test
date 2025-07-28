<div class="ltn__slider-area ltn__slider-3  section-bg-2">
  <div class="ltn__slide-one-active slick-slide-arrow-1 slick-slide-dots-1">
    <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3-normal--- ltn__slide-item-3 bg-image bg-overlay-theme-black-60" data-bs-bg="{{$blockPhoto}}">
      <div class="ltn__slide-item-inner text-center">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 align-self-center">
              <div class="slide-item-info">
                <div class="slide-item-info-inner ltn__slide-animation">
                  <h1 class="slide-title animated updateFont">
                    <span class="number">{{$schema['number'][$thisCurrentLocale ?? null]}}</span>
                    <span class="years">{{$schema['years'][$thisCurrentLocale] ?? null}}</span>
                    <br> {{$schema['h1'][$thisCurrentLocale] ?? null}}
                  </h1>
                  <div class="slide-brief animated updateFont">
                    <p>
                      {{$schema['des'][$thisCurrentLocale] ?? null}}
                    </p>
                  </div>
                  <div class="btn-wrapper animated "><a href="{{$schema['btn_url'][$thisCurrentLocale] ?? null}}" class="theme-btn-1 btn btn-effect-1 updateFont">{{$schema['btn'][$thisCurrentLocale] ?? null}}</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>