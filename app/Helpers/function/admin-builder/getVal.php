<?php
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getData')) {
  function getData( $data, $key, $def = null): ?string {
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
  function getLangData( $data, $key, $def = null): ?string {
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
  function getIntData( $data, $key, $def = 1): ?string {
    if (is_array($data) and isset($data[$key]) and intval($data[$key]) > 0) {
      return $data[$key];
    } else {
      return $def;
    }
  }
}




