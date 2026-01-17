@props([
    'href' => '#',
    'text' => 'Eliminar',
    'id' => null,
])

<a href="{{ $href }}" id="{{ $id }}"
    {{ $attributes->merge([
        'class' => 'btn fst-italic animated-icon back button-eliminar flex-fill flex-md-grow-0 w-100 w-lg-auto',
    ]) }}>


    @if ($text === 'Cancelar')
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 42 42">
            <path fill="currentColor" fill-rule="evenodd"
                d="m21.002 26.588l10.357 10.604c1.039 1.072 1.715 1.083 2.773 0l2.078-2.128c1.018-1.042 1.087-1.726 0-2.839L25.245 21L36.211 9.775c1.027-1.055 1.047-1.767 0-2.84l-2.078-2.127c-1.078-1.104-1.744-1.053-2.773 0L21.002 15.412L10.645 4.809c-1.029-1.053-1.695-1.104-2.773 0L5.794 6.936c-1.048 1.073-1.029 1.785 0 2.84L16.759 21L5.794 32.225c-1.087 1.113-1.029 1.797 0 2.839l2.077 2.128c1.049 1.083 1.725 1.072 2.773 0z" />
        </svg>
    @elseif($text == 'Cerrar')
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
            <path fill="currentColor"
                d="m3.5 2.086l4.5 4.5l4.5-4.5L13.914 3.5L9.414 8l4.5 4.5l-1.414 1.414l-4.5-4.5l-4.5 4.5L2.086 12.5l4.5-4.5l-4.5-4.5z" />
        </svg>
    @else
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
        </svg>
    @endif
    {{ $text }}
</a>
