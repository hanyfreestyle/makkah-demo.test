<?php
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getTranslatedValue')) {
  function getTranslatedValue(?array $translations): ?string {
    if (!is_array($translations)) {
      return null;
    }

    $locale = app()->getLocale();

    return $translations[$locale]
      ?? collect($translations)->filter()->first() // fallback لأول ترجمة غير null
      ?? null;
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('updateFontawesomeIcon')) {
  function updateFontawesomeIcon(?string $icon): ?string {
    $arr = ['fas-', 'fab-'];
    $arr_replace = ['fa fa-', 'fa-brands fa-'];
    return str_replace($arr, $arr_replace, $icon);
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('updateCounterPlusMakkah')) {
  function updateCounterPlusMakkah(?string $value): ?string {
    $line = '';
    // يقبل أرقاماً تحتوي على فواصل آلاف، مع أو بدون علامة +
    if (preg_match('/^([\d,]+)(\+?)$/', $value ?? '', $m)) {
      // لو احتجت الرقم خالياً من الفواصل (لأن بعض إضافات الـ JS تطلبه هكذا)
      $numeric = str_replace(',', '', $m[1]);

      $line .= '<h1><span class="counter" data-target="' . $numeric . '">' . $m[1] . '</span>';
      if ($m[2] === '+') {
        $line .= '<span class="counterUp-icon">+</span>';
      }
      $line .= '</h1>';
    }
    return $line;
  }
}




