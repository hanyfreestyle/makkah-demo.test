@extends('makkah.layouts.app')

@section('content')
  {!! Breadcrumbs::render('about_us') !!}

  <x-builder.load-view-in-page :blocks="$blocks"/>
@endsection


