<?php

namespace App\View\Components\Makkah\Widget;

use App\Models\LatestNews\LatestNews;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LatestNewsFeed extends Component {

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
    if ($this->latestNews == null) {
      $this->latestNews = LatestNews::query()
        ->where('is_active', true)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->orderBy('published_at', 'desc')
        ->take(4)
        ->get();
    }
    $this->option_2 = $option_2;
    $this->option_3 = $option_3;
    $this->option_4 = $option_4;
  }

  public function render(): View|Closure|string {
    return view('components.makkah.widget.latest-news-feed');
  }
}
