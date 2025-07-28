<?php
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getLangData')) {
  function getLangData(array $data, $key, $def = null): ?string {
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
  function getIntData(array $data, $key, $def = 1): ?string {
    if (is_array($data) and isset($data[$key]) and intval($data[$key]) > 0) {
      return $data[$key];
    } else {
      return $def;
    }
  }
}




