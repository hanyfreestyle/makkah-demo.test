<div class="ltn__apartments-plan-area pt-115 pb-70">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title-area ltn__section-title-2--- text-center">
          <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color">Apartment Sketch</h6>
          <h1 class="section-title">Apartments Plan</h1>
        </div>
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
                      <h2 class="updateFont">{{getLangData($item, 'des')}} </h2>
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