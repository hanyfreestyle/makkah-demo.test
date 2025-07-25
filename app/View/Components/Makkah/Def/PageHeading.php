<?php

namespace App\View\Components\Makkah\Def;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeading extends Component {

  public $meta;
  public $des;
  public $option_3;
  public $option_4;

  public function __construct(
    $meta = null,
    $des = true,
    $option_3 = null,
    $option_4 = null,
  ) {
    $this->meta = $meta;
    $this->des = $des;
    $this->option_3 = $option_3;
    $this->option_4 = $option_4;
  }

  public function render(): View|Closure|string {
    return view('components.makkah.def.page-heading');
  }
}
