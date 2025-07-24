@extends('makkah.layouts.app')

@section('content')
  {!! Breadcrumbs::render('about_us') !!}
  <x-makkah.def.latest-news/>
@endsection


