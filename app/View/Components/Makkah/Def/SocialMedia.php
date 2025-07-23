<?php

namespace App\View\Components\Makkah\Def;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SocialMedia extends Component {

  public $type;
  public $webConfig;
  public $option_3;
  public $option_4;

  public function __construct(
    $type = "footer",
    $webConfig = [],
    $option_3 = null,
    $option_4 = null,
  ) {
    $this->type = $type;
    $this->webConfig = $webConfig;
    $this->option_3 = $option_3;
    $this->option_4 = $option_4;
  }

  public function render(): View|Closure|string {
    return view('components.makkah.def.social-media');
  }
}
