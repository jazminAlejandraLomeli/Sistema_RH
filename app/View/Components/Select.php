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
    public string|array $selected;
    public bool $requiredIndicator;
    public bool $disableIndicator;
    public bool $multiple;




    /**
     * Create a new component instance.
     */
    public function __construct(
        string $id,
        string $label,
        string $name,
        array $options = [],
        string|array $selected = '',
        bool $requiredIndicator = false,
        bool $disableIndicator = false,
        bool $multiple = false,


    ) {
        $this->id = $id;
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
        $this->requiredIndicator = $requiredIndicator;
        $this->disableIndicator = $disableIndicator;
        $this->multiple = $multiple || str_ends_with($name, '[]');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
