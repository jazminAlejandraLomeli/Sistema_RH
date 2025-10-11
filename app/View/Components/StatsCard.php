<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatsCard extends Component
{
    public $title;
    public $icon;
    public $value;
    public $id;
    public $color;
//public $tooltip;

    public function __construct($title, $value, $id, $color = 'gb-card1', $icon = '',)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->value = $value;
        $this->id = $id;
        $this->color = $color;
    //    $this->tooltip = $tooltip;
    }

    public function render()
    {
        return view('components.stats-card');
    }
}
