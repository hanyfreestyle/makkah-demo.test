<div class="ltn__about-us-area section-bg-1 aboutUs_3 bg-image-right-before pt-30 pb-50">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 align-self-center">
        <div class="about-us-info-wrap">

          <h3 class=" title updateFont">{{getLangData($schema, 'h1')}}</h3>
          <ul class="listItem clearfix">
            @foreach (explode("\n", getLangData($schema, 'des')) as $line)
              @if(trim($line) !== '')
                <li><i class="fa-solid fa-thumbtack"> </i> {{ $line }}</li>
              @endif
            @endforeach
          </ul>

          <h3 class=" title updateFont">{{getLangData($schema, 'h12')}}</h3>
          <ul class="listItem clearfix">
            @foreach (explode("\n", getLangData($schema, 'des2')) as $line)
              @if(trim($line) !== '')
                <li><i class="fa-solid fa-thumbtack"> </i> {{ $line }}</li>
              @endif
            @endforeach
          </ul>

          {{--          <div class="  ltn__animation-pulse2 text-center mt-30">--}}
          {{--            <a class="ltn__video-play-btn bg-white--- ltn__secondary-bg" href="https://www.youtube.com/embed/HnbMYzdjuBs?autoplay=1&amp;showinfo=0" data-rel="lightcase">--}}
          {{--              <i class="fa-solid fa-play"></i>--}}
          {{--            </a>--}}
          {{--          </div>--}}


        </div>
      </div>

      <div class="col-lg-6 align-self-center">
        <div class="about-us-img-wrap about-img-left">

        </div>
      </div>
    </div>
  </div>
</div>


@push('stackStyle')
  <style>
      .bg-image-right-before::before {
          position: absolute;
          content: "";
          background-size: cover;
          background-position: center center;
          background-repeat: no-repeat;
          background-image: url({{$blockPhoto}});
          height: 100%;
          width: 48%;
          left: auto;
          right: 0;
          top: 0;
      }

  </style>

@endpush


