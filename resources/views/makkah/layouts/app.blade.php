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
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/font-icons.css',"Web",$cssReBuild) !!}
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/plugins.css',$cssMinifyType,$cssReBuild) !!}
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/style.css',$cssMinifyType,$cssReBuild) !!}
  {!! $minifyTools->setDir('makkah/')->MinifyCss('css/edit.css',$cssMinifyType,$cssReBuild) !!}
  @yield('yieldStyle')
  @stack('stackStyle')
</head>
<body>

<div class="body-wrapper">
  @include('makkah.layouts.inc.header_menu_home')



  @yield('content')
  @include('makkah.layouts.inc.footer')

</div>

<div class="preloader d-none" id="preloader">
  <div class="preloader-inner">
    <div class="spinner">
      <div class="dot1"></div>
      <div class="dot2"></div>
    </div>
  </div>
</div>


{!! $minifyTools->setDir('makkah/')->MinifyJs('js/plugins.js',"Web",false) !!}
{!! $minifyTools->setDir('makkah/')->MinifyJs('js/main.js',"Web",false) !!}

@yield('yieldScript')
@stack('stackScript')
</body>
</html>
