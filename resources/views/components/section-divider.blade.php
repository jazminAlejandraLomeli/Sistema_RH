@props([
    'text' => '',
    'color' => '#0284c7',
    'size' => 'fs-5'
])

<hr class="hr-style p-0 m-1">

<p class="text-center pt-0 pb-0 m-0 d-flex align-items-center justify-content-center gap-2">
    {{-- SVG izquierdo --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
        <path fill="none" stroke="{{ $color }}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
    </svg>

    <span class="fw-semibold {{ $size }}">{{ $text }}</span>

    {{-- SVG derecho --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
        <path fill="none" stroke="{{ $color }}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
    </svg>
</p>

<hr class="hr-style p-0 m-1">
