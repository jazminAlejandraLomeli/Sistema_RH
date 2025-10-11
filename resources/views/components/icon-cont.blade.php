<div class="row align-items-center mb-3">
    <!-- Columna para el ícono -->
    <div class="col-auto d-flex align-items-center pe-0 Icon_cont">
        {!! $icon !!}
    </div>

     <!-- Columna para el label y el texto -->
    <div class="col my-0">
        <label class="form-label fw-semibold mb-0">{{ $label }}</label>
        <p class="mb-0" id="{{ $id }}">{{ $text }}</p>
    </div>
</div>
