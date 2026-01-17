@php
    $icon = '
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48">
            <g fill="none" stroke="#e11d48" stroke-linecap="round" stroke-linejoin="round" stroke-width="4">
                 <path d="M44 24V9H4v30h20m16-8l-8 8m0-8l8 8" /><path d="m4 9l20 15L44 9" />
            </g>
        </svg>
        <span class="mt-1"> Pendientes </span>
        ';

    if ($hbd_today['sent']) {
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48"><g fill="none" stroke="#059669" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"><path d="M44 24V9H4v30h20m7-3l5 4l8-10"/><path d="m4 9l20 15L44 9"/></g></svg>
             <span class="mt-1"> enviadas </span>
             ';
    }

@endphp

<div class="modal fade" id="today-birthdays" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content px-2">
            <div class="modal-header py-3">
                <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel"> Cumpleañeros</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <hr class="hr-style p-0 m-1 mb-4">

                <div class="d-flex justify-content-around">
                    <span class="d-none d-md-block">
                        <x-confetty-component></x-confetty-component>
                    </span>

                    <p class="mb-0 fs-4 text-dark text-center mb-3">

                        <span class="fw-bold fst-italic text-primary">
                            {{ $hbd_today['day'] }}
                        </span>
                    </p>
                    <span class="d-none d-md-block">
                        <x-confetty-component></x-confetty-component>
                    </span>
                </div>

                <hr class="hr-style p-0 m-1 mb-4">

                <div class="px-3">
                        <table class="table table-hover align-middle">
                            <thead class="">
                                <tr>
                                    <th scope="col" class="text-start">Nombre del Cumpleañero</th>
                                    <th scope="col" class="text-center">Estado de Envío</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hbd_today['people'] as $people)
                                    <tr>
                                        <td class="fw-normal">
                                            {{ $people['nombre'] }}             
                                        </td>

                                        <td class="text-muted text-center">
                                            {{-- Usamos d-inline-flex y align-items-center para el icono, aunque solo sea un elemento --}}
                                            <div class="d-inline-flex flex-column align-items-center">
                                                {!! $icon !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-end gap-2">
                <div class="flex-fill flex-lg-grow-0">
                    <x-delete-button-component text="Cerrar" data-bs-dismiss="modal" />
                </div>

            </div>

        </div>
    </div>
</div>
