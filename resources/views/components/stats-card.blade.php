
 
<div class="col-sm-6 col-md-3 col-xl-2 px-1 mb-3">
    <div class="card d-flex flex-column align-items-center py-1" >
        <div class="text-cont">
            <p class="mb-0 fst-italic text-center">
                <span class="fw-normal">{{ $title }}</span>
            </p>
        </div>
        <div class="cont-icon pt-1">
            <div tabindex="0" class="rounded-icon {{ $color }} mt-1 show-details" data-id="{{ $id }}" >
                {{ $slot }} <!-- SVG -->
            </div>
        </div>
        <div class="col-12 text-center mt-2">
            <span class="pt-2 pb-3 fs-5 fw-bold">{{ $value }}</span>
        </div>
    </div>
</div>
