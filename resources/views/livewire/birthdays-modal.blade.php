<div>
    <div class="d-flex justify-content-between">
        <span class="d-none d-md-block">
            <x-confetty-component></x-confetty-component>
        </span>

        <p class="mb-0 fs-4 text-dark text-center mb-3">
            {{-- Evento de livewire para mes anterior --}}
            <button wire:click="previousMonth" class="btn btn-sm btn-light me-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20">
                    <path fill="#0B5ED7" d="m2 10l8 8l1.4-1.4L5.8 11H18V9H5.8l5.6-5.6L10 2z" />
                </svg>
            </button>

            <span class="fw-normal">Cumpleañeros de
                <span class="fw-bold fst-italic text-primary">
                    {{ $birthdays['name_month'] }}
                </span>
            </span>
            {{-- Evento de livewire para el siguiente mes --}}
            <button wire:click="nextMonth" class="btn btn-sm btn-light ms-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20">
                    <path fill="#0B5ED7" d="M8.6 3.4L14.2 9H2v2h12.2l-5.6 5.6L10 18l8-8l-8-8z" />
                </svg>
            </button>
        </p>

        <span class="d-none d-md-block">
            <x-confetty-component></x-confetty-component>
        </span>
    </div>

    <hr class="hr-style p-0 m-1 mb-4">

    <div class="row main-cont custom-bg position-relative">

        {{-- Loader para los eventos  --}}
        <div wire:loading.flex class="justify-content-center align-items-center my-3 cont-loader">
            <div class="spinner-grow text-primary me-3" role="status"></div>
            <div class="spinner-grow text-primary me-3" role="status"></div>
            <div class="spinner-grow text-primary me-3" role="status"></div>
        </div>

        @foreach ($birthdays['people'] as $persona)
            <div class="col-6">
                <div class="text-bold d-flex">
                    <span class="icon-list d-flex align-items-center justify-content-center pe-2 flex-shrink-0 d-none d-md-block">
                        <x-confetty-component type="List"></x-confetty-component>
                    </span>

                    <div class="text-center mb-1 flex-grow-1 pt-2">
                        <p class="pb-0 mb-0">
                            {{ $persona['nombre'] }}
                        </p>
                        <p class=" fst-italic">
                            {{ $persona['dia'] }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

        <hr class="hr-style p-0 m-1 mb-4">
    </div>

</div>
