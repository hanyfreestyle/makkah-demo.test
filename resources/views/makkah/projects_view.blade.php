@extends('makkah.layouts.app')

@section('content')

  @if($project->id != 1)
      {!! Breadcrumbs::render('project_view',$project) !!}
  @endif


  <x-builder.load-view-in-page :blocks="$blocks"/>

{{--  <x-makkah.def.page-heading :meta="$project" :des="false"/>--}}
{{--  <div class="container mt-50 mb-50" >--}}
{{--    <div class="row">--}}
{{--      <div class="col-lg-8">--}}
{{--      </div>--}}
{{--    </div>--}}
{{--    </div>--}}
@endsection

@push('stackStyle')
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/blog.css',$cssMinifyType,$cssReBuild) !!}
@endpush




