@extends('makkah.layouts.app')

@section('content')
  {!! Breadcrumbs::render('project_view',$project) !!}

  <x-makkah.def.page-heading :meta="$project" :des="false"/>


@endsection

@push('stackStyle')
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/blog.css',$cssMinifyType,$cssReBuild) !!}
@endpush




