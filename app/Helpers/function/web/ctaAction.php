<?php


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('ctaActionCall')) {
  function ctaActionCall($webConfig): string {
    return "tel:" . $webConfig->phone_call;
  }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('ctaActionCallIcon')) {
  function ctaActionCallIcon(): string {
    if (thisCurrentLocale() == 'en') {
      return ' fa-phone';
    } else {
      return ' fa-phone-alt';
    }
  }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('ctaActionMap')) {
  function ctaActionMap($webConfig): string {
    return $webConfig->google_map_url;
  }
}

if (!function_exists('ctaActionWhatsapp')) {
  function ctaActionWhatsapp($webConfig): string {
    $brek = "%0a";
    $getMass = $webConfig->whatsapp_des;


    $Mass = str_replace(" ", "+", $getMass);
    $Mass = str_replace("*", "%2A", $Mass);
    $Mass = str_replace("#", "%23", $Mass);

    $whatsappUrl = 'https://api.whatsapp.com/send/?phone=' . $webConfig->whatsapp_send . '&text=' . $Mass;
//    $whatsappUrl = 'https://wa.me/?phone=' . $webConfig->whatsapp_send . '&text=' . $Mass;
//    $whatsappUrl = 'https://wa.me/?phone=' . $webConfig->whatsapp_send . '&text=' . $Mass;
//    $whatsappUrl =  "https://wa.me/".$webConfig->whatsapp_send;
//    $whatsappUrl =  "https://api.whatsapp.com/send/?phone=21110510003";
    return $whatsappUrl;
  }
}









