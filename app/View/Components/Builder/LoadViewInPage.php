<?php

namespace App\View\Components\Builder;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LoadViewInPage extends Component {

  public $blocks;
  public $option_2;
  public $option_3;
  public $option_4;

  public function __construct(
    $blocks = null,
    $option_2 = null,
    $option_3 = null,
    $option_4 = null,
  ) {
    $this->blocks = $blocks;
    $this->option_2 = $option_2;
    $this->option_3 = $option_3;
    $this->option_4 = $option_4;
  }

  public function render(): View|Closure|string {
    return view('components.builder.load-view-in-page');
  }
}
