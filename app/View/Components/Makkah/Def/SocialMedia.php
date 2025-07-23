<?php

namespace App\View\Components\Makkah\Def;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SocialMedia extends Component {

  public $type;
  public $webConfig;
  public $cssStyle;
  public $option_4;

  public function __construct(
    $type = "footer",
    $webConfig = [],
    $cssStyle = null,
    $option_4 = null,
  ) {
    $this->type = $type;
    $this->webConfig = $webConfig;
    $this->cssStyle = $cssStyle;

    if ($this->type == "footer") {
      $this->cssStyle = " social_media_footer mt-20 ";
    } elseif ($this->type == "header") {
      $this->cssStyle = " ltn__social-media ";
    }

    $this->option_4 = $option_4;
  }

  public function render(): View|Closure|string {
    return view('components.makkah.def.social-media');
  }
}
