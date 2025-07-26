<?php

namespace App\View\Components\Makkah\Cta;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FooterCta extends Component {

  public $pageView;
  public $option_2;
  public $option_3;
  public $option_4;

  public function __construct(
    $pageView = [],
    $option_2 = null,
    $option_3 = null,
    $option_4 = null,
  ) {
    $this->pageView = $pageView;
    $this->option_2 = $option_2;
    $this->option_3 = $option_3;
    $this->option_4 = $option_4;
  }

  public function render(): View|Closure|string {
    return view('components.makkah.cta.footer-cta');
  }
}
