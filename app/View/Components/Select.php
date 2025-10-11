<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public string $id;
    public string $label;
    public string $name;
    public array $options;
    public string $selected;
    public bool $requiredIndicator;
    public bool $disableIndicator;




    /**
     * Create a new component instance.
     */
    public function __construct(
        string $id,
        string $label,
        string $name,
        array $options = [],
        string $selected = '',
        bool $requiredIndicator = false,
        bool $disableIndicator = false,

    ) {
        $this->id = $id;
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
        $this->requiredIndicator = $requiredIndicator;
        $this->disableIndicator = $disableIndicator;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
