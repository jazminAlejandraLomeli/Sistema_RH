{{-- Breadcrumb para mostrarlo en cada una de las vistas --}}
<nav class="d-flex justify-content-center justify-content-md-start" aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (isset($breadcrumb['url']))
                <li class="breadcrumb-item ">
                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                </li>
            @else
                <li class="breadcrumb-item active">
                    {{ $breadcrumb['name'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>
