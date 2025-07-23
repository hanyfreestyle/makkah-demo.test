<?php

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('printArrow')) {
    function printArrow(): string {
        if (thisCurrentLocale() == 'en') {
            $icon = '<i class="fas fa-arrow-right"></i>';
        } else {
            $icon = '<i class="fas fa-arrow-left" ></i>';
        }
        return $icon;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('printPhoneIcon')) {
    function printPhoneIcon(): string {
        if (thisCurrentLocale() == 'en') {
            $icon = '<i class="fa-solid fa-phone"></i>';
        } else {
            $icon = '<i class="fas fa-phone-alt"></i>';
        }
        return $icon;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('ctaWhatsappMass')) {
    function ctaWhatsappMass($webConfig, $unitData): string {
//        dd($webConfig->whatsapp_send);
        $isArabic = app()->getLocale() === 'ar';
        $rtlMark = $isArabic ? "\u{200F}" : '';

        $message = $rtlMark . __('webLang/whatsapp.cta_intro') . "\n";
        if ($unitData->listing_type == 'Project') {
            $message .= "*" . __('webLang/whatsapp.project') . ":* " . ($unitData->name ?? '—') . "\n";
        } elseif ($unitData->listing_type == 'Unit') {
            $message .= "*" . __('webLang/whatsapp.project') . ":* " . ($unitData->project->name ?? '—') . "\n";
            $message .= "*" . __('webLang/whatsapp.unit') . ":* " . ($unitData->name ?? '—') . "\n";
        } elseif ($unitData->listing_type == 'ForSale') {

        }

//        $message .= "*" . __('webLang/whatsapp.reference') . ":* " . ($unitData->id ?? '—');

        // ترميز النص ليكون مناسبًا لرابط واتساب
        $encodedMessage = urlencode($message);
        // رقم الواتساب (تأكّد أنه بصيغة دولية بدون "+" مثلاً: 201234567890)
        $whatsappNumber = $webConfig->whatsapp_send ?? '201110510003';
        // توليد رابط الواتساب النهائي
        $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$encodedMessage}";

        return $whatsappUrl;

    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('number_format_print')) {
    function number_format_print($num): string {
        $num = intval($num);
        return number_format($num);
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('updateFontIcon')) {
    function updateFontIcon($getIcon): string {
        $arrFrom = [
            'fas-',
            'far-',
        ];
        $arrTo = [
            'fas fa-',
            'fas fa-',
        ];
        return str_replace($arrFrom, $arrTo, $getIcon);
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getLocationPathFromArray')) {
    function getLocationPathFromArray($locationTree): string {
        $links = collect($locationTree)->map(function ($location) {
            return '<a href="' . route('page_locationView', $location['slug']) . '">' . e($location['name']) . '</a>';
        });

        return $links->implode(', ');
    }
}


