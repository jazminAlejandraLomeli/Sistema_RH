<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IconCont extends Component
{
    public $icon;
    public $label;
    public $text;
    public $id;

    public function __construct($icon, $label, $text, $id)
    {
        $this->icon = $icon;
        $this->label = $label;
        $this->text = $text;
        $this->id = $id;
    }

    public function render()
    {
        return view('components.icon-cont');
    }
}
