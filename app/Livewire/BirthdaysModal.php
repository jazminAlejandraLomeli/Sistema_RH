<?php

namespace App\Livewire;

use App\Models\Administrativo;
use Carbon\Carbon;
use Livewire\Component;

class BirthdaysModal extends Component
{
    public $month;

    public $birthdays = [];


    public function mount($month)
    {
        $this->month = $month; 
        $this->loadBirthdays();
    }


    public function previousMonth()
    {
        $this->month = Carbon::create(null, $this->month)->subMonth()->month;
        $this->loadBirthdays();
    }

    public function nextMonth()
    {
        $this->month = Carbon::create(null, $this->month)->addMonth()->month;
        $this->loadBirthdays();
    }

    public function loadBirthdays()
    {
        $people = Administrativo::where('estado_id', 1)
            ->whereMonth('fecha_nacimiento', $this->month)
            ->orderByRaw('DAY(fecha_nacimiento) ASC')
            ->get()
            ->map(function ($persona) {
                $fecha = Carbon::parse($persona->fecha_nacimiento);
                $cumpleEsteAnio = Carbon::create(now()->year, $fecha->month, $fecha->day);

                return [
                    'nombre' => $persona->nombre,
                    'dia' => $cumpleEsteAnio->locale('es')->isoFormat('dddd D'),
                ];
            });

        $this->birthdays = [
            'name_month' => Carbon::create(null, $this->month)->locale('es')->monthName,
            'count' => $people->count(),
            'people' => $people,
            'month_number' => $this->month,
        ];
    }



    public function render()
    {
        return view('livewire.birthdays-modal');
    }
}
