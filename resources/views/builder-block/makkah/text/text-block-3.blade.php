<div class="ltn__about-us-area section-bg-1 bg-image-right-before pt-30 pb-50">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 align-self-center">
        <div class="about-us-info-wrap">
          <div class="section-title-area ltn__section-title-2--- mb-20">



          </div>
          <h3>{{getLangData($schema, 'h1')}}</h3>
          <ul class="ltn__list-item-half ltn__list-item-half-2 list-item-margin clearfix">
            @foreach (explode("\n", getLangData($schema, 'des')) as $line)
              @if(trim($line) !== '')
                 <li> <i class="fa-solid fa-thumbtack"> </i> {{ $line }}</li>
              @endif
            @endforeach
          </ul>

          <h3>{{getLangData($schema, 'h12')}}</h3>
          <ul class="ltn__list-item-half ltn__list-item-half-2 list-item-margin clearfix">
            @foreach (explode("\n", getLangData($schema, 'des2')) as $line)
              @if(trim($line) !== '')
                <li> <i class="fa-solid fa-thumbtack"> </i> {{ $line }}</li>
              @endif
            @endforeach
          </ul>

          <div class="  ltn__animation-pulse2 text-center mt-30 d-none">
            <a class="ltn__video-play-btn bg-white--- ltn__secondary-bg" href="https://www.youtube.com/embed/HnbMYzdjuBs?autoplay=1&amp;showinfo=0" data-rel="lightcase">
              <i class="icon-play  ltn__secondary-color--- white-color"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 align-self-center">
        <div class="about-us-img-wrap about-img-left">

        </div>
      </div>
    </div>
  </div>
</div>