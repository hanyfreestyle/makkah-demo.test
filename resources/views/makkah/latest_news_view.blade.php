@extends('makkah.layouts.app')

@section('content')
  {!! Breadcrumbs::render('latest_news') !!}

  {{$news->name}}
@endsection



