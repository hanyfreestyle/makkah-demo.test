<?php

namespace App\View\Components\Makkah\Cursor;

use App\Models\LatestNews\LatestNews;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class News extends Component {

  public $latestNews;
  public int $take ;
  public string|null $title;
  public $option_4;

  public function __construct(
    $latestNews = null,
    $take = 6,
    $title = null,
    $option_4 = null,
  ) {
    $this->latestNews = $latestNews;
    $this->take = $take;

    if ($this->latestNews == null) {
      $this->latestNews = LatestNews::query()
        ->where('is_active', true)
        ->orderBy('created_at')
        ->take($this->take)
        ->get();
    }


    $this->title = $title;
    $this->option_4 = $option_4;
  }

  public function render(): View|Closure|string {
    return view('components.makkah.cursor.news');
  }
}
