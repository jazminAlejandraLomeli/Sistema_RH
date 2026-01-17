<div class="card">
    <h5 class="card-header bg-blue-primary text-white text-center">Actualizar datos del domicilio</h5>
    <div class="card-body ">
        {{-- <p class="pt-1 mb-0">Escribe los datos correspondientes para agregar nuevo trabajador al sistema.</p> --}}

        <div class="row  px-2">
            <p> Actualiza los datos que hayan cambiado o que no sea correctos y da clic en <b> Guardar</b>.
            </p>

            <x-section-divider text="Datos del domicilio" color="#65a30d" />
         <div class="col-12 col-md-6 col-xl-6 mt-1 ">

                @php
                    $states = collect(config('collections.estados'));
                @endphp

                <x-select id="state" label="Estado" name="state" selected="{{ $Worker->domicilio->estado ?? '' }}"
                :options="['' => 'Selecciona un estado'] + $states->pluck('nombre', 'id')->toArray()" />

                <x-input id="city" label="Ciudad" name="city" placeolder="Tepatitlán de Morelos" value="{{ $Worker->domicilio->ciudad ?? '' }}" />
                <x-input id="calle" label="Calle" name="calle" placeolder="Av. López López" value="{{ $Worker->domicilio->calle ?? '' }}" />

            </div>

            <div class="col-12 col-md-6 col-xl-6 mt-1 ">
                <div class="row">
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="colonia" label="Colonia" name="colonia" placeolder="Las colonias" value="{{ $Worker->domicilio->colonia ?? '' }}"/>


                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="cp" label="Código Postal" name="cp" placeolder='47600' value="{{ $Worker->domicilio->cp ?? '' }}"
                            maxlength="5" />

                    </div>
                </div>

                <div class="row">

                    <div class="col-12 col-md-6 col-xl-6">
                        <x-input id="numero" label="Número" name="numero" placeolder='55 A' value="{{ $Worker->domicilio->numero ?? '' }}" maxlength="10"/>

                    </div>
                </div>

             </div> 

        </div>

        {{-- Botones --}}
        <hr class="border border-primary border-2 opacity-50">
        @include('workers.details.update.partials.address-buttons')

    </div>
</div>
