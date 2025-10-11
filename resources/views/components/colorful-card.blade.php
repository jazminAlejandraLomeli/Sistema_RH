@props(['color', 'title', 'count', 'subtitle', 'link' => null, 'icon'])

<div class="col-6 col-md-4 col-xl-3 mb-4">
    <div class="card py-2 px-2 {{ $color }}">
        <div class="text-cont d-flex justify-content-start">
            <p class="mb-0 text-justify fw-normal">
                {{ $title ?? 'Próximos a vencer' }}
            </p>
        </div>

        <div class="col-12 text-start mx-0 d-flex justify-content-between px-3">
            @if($link)
                <a href="{{ $link }}" class="fs-2 fw-bold rounded-icon">
                    {{ $count }}
                </a>
            @else
                <span class="fs-2 fw-bold rounded-icon">
                    {{ $count }}
                </span>
            @endif
            
            <div class="mt-2">
                {{ $icon }}
            </div>
        </div>

        <div class="text-cont mt-0 d-flex justify-content-start">
            <p class="fst-italic text-justify">
                <span class="fw-normal"> <i>{{ $subtitle ?? 'Temporales e interinatos' }}</i></span>
            </p>
        </div>
    </div>
</div>