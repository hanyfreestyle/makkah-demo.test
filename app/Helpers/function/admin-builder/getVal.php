<?php
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getData')) {
  function getData($data, $key, $def = null): ?string {
    if (is_array($data) and isset($data[$key])) {
      return $data[$key];
    } else {
      return $def;
    }
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getLangData')) {
  function getLangData($data, $key, $def = null): ?string {
    $thisCurrentLocale = thisCurrentLocale();
    if (is_array($data) and isset($data[$key][$thisCurrentLocale])) {
      return $data[$key][$thisCurrentLocale];
    } else {
      return $def;
    }
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getIntData')) {
  function getIntData($data, $key, $def = 1): ?string {
    if (is_array($data) and isset($data[$key]) and intval($data[$key]) > 0) {
      return $data[$key];
    } else {
      return $def;
    }
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getPaddingSize')) {
  function getPaddingSize(?array $data, ?string $def = null): ?string {
    $paddingKeys = ['pt', 'pb', 'pl', 'pr'];
    $classes = [];
    foreach ($paddingKeys as $key) {
      if (isset($data[$key]) && is_string($data[$key])) {
        // replace p- with the actual key (e.g., pt)
        $classes[] = preg_replace('/^p-/', $key . '-', $data[$key]);
      }
    }
    return count($classes) ? implode(' ', $classes) : $def;
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getMarginSize')) {
  function getMarginSize(?array $data, ?string $def = null): ?string {
    $paddingKeys = ['mt', 'mb', 'ml', 'mr'];
    $classes = [];
    foreach ($paddingKeys as $key) {
      if (isset($data[$key]) && is_string($data[$key])) {
        // replace p- with the actual key (e.g., pt)
        $classes[] = preg_replace('/^m-/', $key . '-', $data[$key]);
      }
    }
    return count($classes) ? implode(' ', $classes) : $def;
  }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getColumnsSize')) {
  function getColumnsSize(?array $data, ?string $def = null): ?string {

    $classes = [];

    if (isset($data['col'])) {
      $classes[] = match ($data['col']) {
        'col-1' => 'col-lg-12 col-md-12',
        'col-2' => 'col-lg-6 col-md-6',
        'col-3' => 'col-lg-4 col-md-4',
        'col-4' => 'col-lg-3 col-md-3',
        'col-6' => 'col-lg-2 col-md-2',
        default => null,
      };
    }

    if (isset($data['col-m'])) {
      $classes[] = match ($data['col-m']) {
        'col-1' => 'col-12 col-sm-12',
        'col-2' => 'col-6 col-sm-6',
        'col-3' => 'col-4 col-sm-4',
        'col-4' => 'col-3 col-sm-3',
        'col-6' => 'col-2 col-sm-2',
        default => null,
      };
    }

    // نحذف أي null أو empty ونرجعهم كسطر واحد
    return collect($classes)
      ->filter()
      ->implode(' ');

  }
}





