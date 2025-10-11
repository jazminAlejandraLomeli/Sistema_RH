<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MaleFemaleStadistic extends Component
{
    public $title;
    public $male;
    public $female;
    public $total;
    public $tooltip;

    public function __construct($title = '', $male = 0, $female = 0, $total = 0, $tooltip = "" )
    {
        $this->title = $title;
        $this->male = $male;
        $this->female = $female;
        $this->total = $total;
        $this->tooltip = $tooltip;
    }

    public function render(): View|Closure|string
    {
        return view('components.male-female-stadistic');
    }
}
