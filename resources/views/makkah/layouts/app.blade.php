<!doctype html>
<html lang="{{ thisCurrentLocale() }}" {!!htmlDir()!!} >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    {!! SEO::generate() !!}
    <x-web.def.fav-icon/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if(thisCurrentLocale() == 'en')
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    @endif
{{--    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/default.css',$cssMinifyType,$cssReBuild) !!}--}}
{{--    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/inc/header.css',$cssMinifyType,$cssReBuild) !!}--}}
{{--    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/inc/breadcrumbs.css',$cssMinifyType,$cssReBuild) !!}--}}
{{--    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/inc/page-title.css',$cssMinifyType,$cssReBuild) !!}--}}
{{--    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/inc/pagination.css',$cssMinifyType,$cssReBuild) !!}--}}
{{--    {!! $minifyTools->setDir('real-estate/')->MinifyCss('css/inc/footer.css',$cssMinifyType,$cssReBuild) !!}--}}
{{--    <x-real-estate-eg.inc.style-file/>--}}
    @yield('yieldStyle')
    @stack('stackStyle')
</head>
<body>
{{--@include('real-estate.layouts.inc.header_menu_fix')--}}

@yield('content')

{{--@include('real-estate.layouts.inc.footer')--}}

{{--{!! $minifyTools->setDir('realestate-eg/')->MinifyJs('js/jquery-3.7.1.min.js',"Web",false) !!}--}}
{{--{!! $minifyTools->setDir('real-estate/')->MinifyJs('js/default.js',"Web",false) !!}--}}

@yield('yieldScript')
@stack('stackScript')
</body>
</html>
