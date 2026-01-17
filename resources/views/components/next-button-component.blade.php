@props([
    'href' => '#',
    'text' => 'Siguiente',
    'id' => null,
    'description' => 'Botón'
])

<a href="{{ $href }}" id="{{ $id }}"
    {{ $attributes->merge([
        'class' => 'btn fst-italic animated-icon button-add w-100 w-lg-auto',
    ]) }} aria-label="{{ $description }}">


    @if ($text === 'Nombramiento' || $text === 'Agregar')
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
        </svg>
    @else
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" stroke-width="2" d="M6 12.4h12M12.6 7l5.4 5.4l-5.4 5.4" />
        </svg>
    @endif
    {{ $text }}
</a>
