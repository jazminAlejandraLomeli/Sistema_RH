<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Log;

class LogsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // o 'tailwind'

    public function render()
    {
        $logs = Log::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        // Transformamos los datos pero sin perder la paginación
        $logs->getCollection()->transform(function ($log) {
            return [
                'id' => $log->id,
                'accion' => $log->accion,
                'tipo' => $log->tipo,
                'descripcion' => $log->descripcion,
                'nombre' => $log->user->name,
                'user_name' => $log->user->user_name,
                // 'fecha' => $log->created_at?->format('d/m/Y H:i'),
                'fecha' => $log->created_at?->diffForHumans(),
            ];
        });
   //     dd($logs);
        return view('livewire.logs-list', ['data' => $logs]);
    }
}
