@extends('makkah.layouts.app')

@section('content')

  @include('makkah.layouts.inc.home_slider')

  {{--  @include('makkah.layouts.block.home_project')--}}
  {{--  @include('makkah.layouts.block.home_counter')--}}
  {{--  @include('makkah.layouts.block.home_plan')--}}
{{--  @include('makkah.layouts.block.home_blog')--}}


@endsection

@push('stackStyle')
  {{--      {!! $minifyTools->setDir('real-estate/')->MinifyCss('vendor/swiper/swiper-bundle.min.css',$cssMinifyType,$cssReBuild) !!}--}}
@endpush


@push('stackScript')
  {{--    {!! $minifyTools->setDir('real-estate/')->MinifyJs('vendor/swiper/swiper-bundle.min.js',"Web",false) !!}--}}
@endpush

