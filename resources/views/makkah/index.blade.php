@extends('makkah.layouts.app')

@section('content')

  @include('makkah.layouts.inc.home_slider')

  @foreach ($blocks as $block)
    @php
      $template  = $block->template?->template; // مثل: 'makkah'
      $type      = $block->template?->type;     // مثل: 'counter'
      $slug      = $block->template?->slug;     // مثل: 'counter-1'
      $viewPath  = "builder-block.$template.$type.$slug";
    @endphp

    @if(View::exists($viewPath))
      @include($viewPath, [
          'block' => $block,
          'settings' => $block->settings,
      ])

{{--      {{dd($block->schema)}}--}}
    @else
      <div class="bg-red-100 text-red-600 p-4 my-2">
        العرض غير متاح لهذا البلوك ({{ $viewPath }})
      </div>
    @endif

  @endforeach



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

