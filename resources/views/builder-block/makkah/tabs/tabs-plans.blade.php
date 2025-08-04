<div class="ltn__apartments-plan-area {{getPaddingSize($config) }}   {{getMarginSize($config) }}">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        @if(getLangData($schema,'h1'))
          <div class="section-title-area ltn__section-title-2--- text-center">
            @if(getLangData($schema,'h1'))
              <h2 class="updateFont">{{getLangData($schema,'h1')}}</h2>
            @endif
            @if(getLangData($schema,'des'))
              <p>{{getLangData($schema,'des')}}</p>
            @endif
          </div>
        @endif


        <div class="ltn__tab-menu ltn__tab-menu-3 ltn__tab-menu-top-right-- text-uppercase--- text-center">
          <div class="nav">
            @foreach($block->schema['items']  as $loopIndex => $item)
              <a data-bs-toggle="tab" class="@if($loopIndex == 0) active show @endif  updateFont" href="#liton_tab_3_{{$loopIndex}}">{{getLangData($item, 'name')}} </a>
            @endforeach
          </div>
        </div>
        <div class="tab-content">

          @foreach($block->schema['items']  as $loopIndex => $item)
            <div class="tab-pane fade @if($loopIndex == 0) active show @endif" id="liton_tab_3_{{$loopIndex}}">
              <div class="ltn__apartments-tab-content-inner">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="apartments-plan-info ltn__secondary-bg--- section-bg-1 text-color-white---">
                      <h3 class="updateFont">{{getLangData($item, 'des')}} </h3>
                      <p>{{getLangData($item, 'des_2')}} </p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="apartments-plan-img">
                      <img src="{{ Storage::disk('root_folder')->url(getData($item, 'photo'))}}" alt="{{getLangData($item, 'name')}}">
                    </div>
                  </div>
                </div>
              </div>
            </div>

          @endforeach


        </div>
      </div>
    </div>
  </div>
</div>


@push('stackStyle')
  <style>

      .ltn__tab-menu-3 a {
          background-color: transparent;
          border-bottom: 2px solid transparent;
          padding: 1px;
          margin-right: 50px;
          font-weight: 600;
          font-size: 20px;
          line-height: 1.2;
          position: relative;
          padding-bottom: 10px !important;
      }

      .ltn__tab-menu-3 a::before {
          position: absolute;
          content: "";
          right: 45%;
          top: 100%;
          -webkit-transform: translateY(-40%);
          -ms-transform: translateY(-40%);
          transform: translateY(-40%);
          height: 10px;
          width: 10px;
          background-color: transparent;
          opacity: 1;
          border: 3px solid transparent;
          border-radius: 100%;

      }


      html[lang="ar"] .ltn__tab-menu-3 a {
          margin-right: 0;
          margin-left: 50px;

      }

      html[lang="ar"] .ltn__tab-menu-3 a::before {
          position: absolute;
          content: "";
          right: auto;
          left: 45%;
          top: 100%;
          -webkit-transform: translateY(-40%);
          -ms-transform: translateY(-40%);
          transform: translateY(-40%);
          height: 10px;
          width: 10px;
          background-color: transparent;
          opacity: 1;
          border: 3px solid transparent;
          border-radius: 100%;
      }


      .apartments-plan-info {
          padding: 30px 50px;
      }

      .apartments-plan-info h3 {
          font-size: 22px;
          text-align: center;
          margin-bottom: 10px;
      }

      .apartments-plan-info p {
          margin: 0;

      }


      /* للشاشات الصغيرة */
      @media (max-width: 768px) {


          .ltn__tab-menu-3 a {
              margin-right: 10px;
              font-weight: 600;
              font-size: 17px;
          }

          html[lang="ar"] .ltn__tab-menu-3 a {
              margin-right: 0;
              margin-left: 20px;

          }

          .apartments-plan-info {
              padding: 20px 40px;
          }

          .apartments-plan-info h3 {
              font-size: 19px;

          }

          .apartments-plan-info p {
              margin: 0;

          }

          .ltn__tab-menu {
              margin-bottom: 15px;
          }

      }
  </style>
@endpush
