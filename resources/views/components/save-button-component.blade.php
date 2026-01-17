@props([
    'href' => '#',
    'text' => 'Guardar',
    'id' => null,
    'description' => 'Botón',
])

<a href="{{ $href }}" id="{{ $id }}"
    {{ $attributes->merge([
        'class' => 'btn fst-italic animated-icon back button-save w-100 w-lg-auto',
    ]) }}
    aria-label="{{ $description }}">

    @if ($text == 'Buscar')
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <g fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="7" />
                <path stroke-linecap="round" d="m20 20l-3-3" />
            </g>
        </svg>
    @elseif($text == 'Enviar')
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 26 26">
            <path fill="currentColor" d="M0 2v8.5L15 13L0 15.5V24l26-11z" />
        </svg>
    @elseif($text != 'Guardar' && $text != 'Enviar')
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <path fill="currentColor" d="M10.5 3h3v3h-3zm0 7.5h3v3h-3zm0 7.5h3v3h-3z" />
        </svg>
    @else
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
            <path fill="currentColor" d="m15.3 5.3l-6.8 6.8l-2.8-2.8l-1.4 1.4l4.2 4.2l8.2-8.2z" />
        </svg>
    @endif
    {{ $text }}
</a>
