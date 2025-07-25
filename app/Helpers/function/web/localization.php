<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('thisCurrentLocale')) {
  function thisCurrentLocale(): string {
    return LaravelLocalization::getCurrentLocale();
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('htmlDir')) {
  function htmlDir(): string {
    $sendStyle = ' dir="' . LaravelLocalization::getCurrentLocaleDirection() . '" ';
    return $sendStyle;
  }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('webChangeLocale')) {
  function webChangeLocale(): string {
    $Current = LaravelLocalization::getCurrentLocale();
    if ($Current == 'ar') {
      $change = 'en';
    } else {
      $change = 'ar';
    }
    return $change;
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('webChangeLocaleText')) {
  function webChangeLocaleText(): string {
    $Current = LaravelLocalization::getCurrentLocale();
    if ($Current == 'ar') {
      $change = 'English';
    } else {
      $change = 'عربى';
    }
    return $change;
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('setLocalizationRoute')) {
  function setLocalizationRoute($route): string {
    return LaravelLocalization::localizeUrl($route);
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('createPagesLink')) {
  function createPagesLink($lang, $pageData): string {
    $link = '';

    if ($pageData->compound_id != null) {
      $parameters = optional($pageData->project)->slug . $pageData->hash;
    } else {
      $parameters = optional($pageData->location)->slug . $pageData->hash;
    }

    $link .= LaravelLocalization::getLocalizedURL($lang, route('page_ListingPageView', $parameters));
    return $link;
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('textDir')) {
  function textDir(): string {
    if (thisCurrentLocale() == 'en') {
      $icon = 'text-end';
    } else {
      $icon = 'text-start';
    }
    return $icon;
  }
}

if (!function_exists('localizationDirSame')) {
  function localizationDirSame(): string {
    if (thisCurrentLocale() == 'en') {
      return 'left';
    } else {
      return 'right';
    }
  }
}

if (!function_exists('localizationDirDifferent')) {
  function localizationDirDifferent(): string {
    if (thisCurrentLocale() == 'en') {
      return 'right';
    } else {
      return 'left';
    }
  }
}







