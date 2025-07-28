<?php

namespace App\View\Components\Makkah\Cursor;

use App\Models\LatestNews\LatestNews;
use App\Models\Makkah\MakkahProject;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Project extends Component {

  public $projectList;
  public int $take;
  public string|null $title;
  public $des;

  public function __construct(
    $projectList = null,
    $take = 6,
    $title = null,
    $des = null,
  ) {
    $this->projectList = $projectList;
    $this->take = $take;

    if ($this->projectList == null) {
      $this->projectList = MakkahProject::query()
        ->where('is_active', true)
        ->orderBy('created_at')
        ->take($this->take)
        ->get();
    }

    $this->title = $title;
    $this->des = $des;
  }

  public function render(): View|Closure|string {
    return view('components.makkah.cursor.project');
  }
}
