@props([
    'text' => '',
    'type' => '',
])

@php
    $logs = config('icons-colors.types');
    $icon = $logs[$type]['icon'] ?? '';
    $color = $logs[$type]['color'] ?? '#6c757d'; // gris por defecto
    $bgColor = $color . '20'; // añadir opacidad 
@endphp

<div class="d-flex justify-content-between align-items-center mb-1">
    <div>
        <h5 class="fw-bold">{{ $text }}</h5>
    </div>
    <div class="rounded-circle d-flex justify-content-center align-items-center icon-card"
        style="background-color: {{ $bgColor }};">
        {!! $icon !!}
    </div>
</div>
