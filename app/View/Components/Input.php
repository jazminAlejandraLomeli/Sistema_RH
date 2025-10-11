<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public string $id;
    public string $label;
    public string $name;
    public string $type;
    public string $value;
    public bool $uppercase;
    public bool $requiredIndicator;
    public bool $disableIndicator;
    public ?int $maxlength;  // Añadido para manejar el atributo maxlength

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $id,
        string $label,
        string $name,
        string $type = 'text',
        string $value = '',
        bool $uppercase = false,
        bool $requiredIndicator = false,
        bool $disableIndicator = false,
        ?int $maxlength = null // Nuevo parámetro opcional para maxlength
    ) {
        $this->id = $id;
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->uppercase = $uppercase;
        $this->requiredIndicator = $requiredIndicator;
        $this->disableIndicator = $disableIndicator;
        $this->maxlength = $maxlength;  // Asigna el valor de maxlength
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
