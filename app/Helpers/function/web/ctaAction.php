<?php


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('ctaActionCall')) {
  function ctaActionCall($webConfig): string {
//    dd($webConfig->phone_call);
    return "tel:".$webConfig->phone_call;
  }
}








