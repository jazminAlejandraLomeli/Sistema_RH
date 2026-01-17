<!-- Agregar nombramiento secundario  -->
@role('Administrador')

    {{-- @include('workers.details.partialsNEW.modals.add-job') --}}

    <div class="mt-2 col-12 mb-1 d-flex justify-content-end">
        @if ($Worker->trabajos->count() === 1 || $Worker->trabajos->count() === 0)
            @php
                $text = 'Agregar un segundo nombramiento';
                if ($Worker->trabajos->count() === 0) {
                    $text = 'Agregar nombramiento';
                }
            @endphp

            <div>

                <div data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="{{ $text }}">
                    <x-next-button-component text="Nombramiento" description="Boton para agregar segundo nombramiento"
                        href="{{ route('worker.detalles.add-job', $Worker->id) }}" />
                </div>
            </div>
        @endif
    </div>
@endrole
