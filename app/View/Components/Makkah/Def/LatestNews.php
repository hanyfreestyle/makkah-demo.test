<?php

namespace App\View\Components\Makkah\Def;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LatestNews extends Component {

  public $latestNews;
  public $option_2;
  public $option_3;
  public $option_4;

  public function __construct(
    $latestNews = null,
    $option_2 = null,
    $option_3 = null,
    $option_4 = null,
  ) {
    $this->latestNews = $latestNews;
    if ($this->latestNews == null) {
      $this->latestNews = \App\Models\LatestNews\LatestNews::query()
        ->where('is_active', true)
        ->orderBy('created_at', 'DESC')
        ->take(6)
        ->get();
    }
    $this->option_2 = $option_2;
    $this->option_3 = $option_3;
    $this->option_4 = $option_4;
  }

  public function render(): View|Closure|string {
    return view('components.makkah.def.latest-news');
  }
}
