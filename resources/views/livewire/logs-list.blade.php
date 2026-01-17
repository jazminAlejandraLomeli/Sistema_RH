<div class="position-relative">
    <hr class="hr-style p-0 m-1 mb-4">

    <!-- Contenedor principal de logs -->
    <div class="row log-container">
        @foreach ($data as $log)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <x-type-log-icon-component text="{{ $log['accion'] }}" type="{{ $log['tipo'] }}" />
                        <x-description-log-component :texto="$log['descripcion']" />
                        <x-user-data-log-component :date="$log['fecha']" :name="$log['nombre']" :user_name="$log['user_name']" />
                    </div>
                </div>
            </div>
        @endforeach

        @if ($data->isEmpty())
            <div class="col-12">
                <div class=" ">

                    <p class="text-center fs-5">Oooops, por el momento no hay logs</p>

                </div>
            </div>
        @endif
    </div>

    <hr class="hr-style p-0 m-1">

    <!-- Paginación de livewire -->
    <div class="mt-3">
        <!-- paginación reactiva -->
        {{ $data->links() }}
    </div>

    <!--
        Loader Livewire  esto se muestra automáticamente mientras se ejecuta cualquier acción de Livewire
         (click, cambio de input, etc.) y desaparece cuando termina la acción
        -->
    <div wire:loading.flex class="justify-content-center align-items-center my-3 cont-loader">
        <div class="spinner-border text-primary me-2" role="status"></div>
        <span class="text-muted">Cargando...</span>
    </div>
</div>
