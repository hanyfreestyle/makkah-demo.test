@extends('errors.layouts.app')

@section('content')
  <div class="ltn__404-area ltn__404-area-1 mt-65 mb-120">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="error-404-inner text-center">
            <div class="error-img mb-30">
              <img src="{{defImagesDir('err_404','photo')}}" alt="404" class="img_404"/>
            </div>
            <h1 class="error-404-title d-none updateFont">404</h1>
            <h2 class="updateFont">{{__('web/def.err_404.h2')}}</h2>
            <p>{{__('web/def.err_404.text')}}</p>
            <div class="btn-wrapper">
              <a href="{{route('web.index')}}" class="btn btn-transparent updateFont">
                {{__('web/def.err_404.btn')}}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection




