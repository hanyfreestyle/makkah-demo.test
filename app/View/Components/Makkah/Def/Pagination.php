<?php

namespace App\View\Components\Makkah\Def;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component {

  public $rows;
  public $option_2;


  public function __construct(
    $rows = null,
    $option_2 = null,

  ) {
    $this->rows = $rows;
    $this->option_2 = $option_2;

  }

  public function render(): View|Closure|string {
    return view('components.makkah.def.pagination');
  }
}
