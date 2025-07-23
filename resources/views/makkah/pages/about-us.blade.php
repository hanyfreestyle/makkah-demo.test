@extends('real-estate.layouts.app')

@section('content')
    {!! Breadcrumbs::render('about_us') !!}

    <main id="main-content">
        <x-real-estate-eg.home.why-choose-us/>
        <x-real-estate-eg.home.property-types/>
        <x-real-estate-eg.home.statistics/>
        <x-real-estate-eg.home.newsletter/>
    </main>
@endsection

@push('stackStyle')
    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/home/def-home.css',$cssMinifyType,$cssReBuild) !!}
    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/home/property-types.css',$cssMinifyType,$cssReBuild) !!}
    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/home/statistics.css',$cssMinifyType,$cssReBuild) !!}
    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/home/why-choose-us.css',$cssMinifyType,$cssReBuild) !!}
    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/home/newsletter.css',$cssMinifyType,$cssReBuild) !!}
@endpush


@push('stackScript')


@endpush

