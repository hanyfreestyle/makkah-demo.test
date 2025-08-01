<?php

namespace App\View\Components\Makkah\Widget;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FollowUs extends Component
{

    public $option_1;
    public $option_2;
    public $option_3;
    public $option_4;

    public function __construct(
        $option_1 = null,
        $option_2 = null,
        $option_3 = null,
        $option_4 = null,
    )
    {
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
    }

    public function render(): View|Closure|string
    {
        return view('components.makkah.widget.follow-us');
    }
}
