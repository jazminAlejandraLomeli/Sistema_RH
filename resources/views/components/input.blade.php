@php
if($disableIndicator){
 $class = 'form-disabled';
}else {
 $class = '';
}
    

@endphp

<div class="form-group pt-3">
    <label for="{{ $id }}" class="fw-medium ">
        {{ $label }}
        @if ($requiredIndicator)
            <span class="text-danger fw-bolder">*</span>
        @endif
    </label>
    <input  type="{{ $type }}" class="form-control {{ $class }}" id="{{ $id }}" name="{{ $name }}" 
        value="{{ old($name, $value) }}"
        {{ $uppercase ? 'oninput=this.value=this.value.toUpperCase()' : '' }}
        @if($placeolder) placeholder="{{ $placeolder }}" @endif
        @if($maxlength) maxlength="{{ $maxlength }}" @endif  @if($disableIndicator) disabled @endif>  
    <span class="text-danger fw-normal" style="display: none;">{{ $label }} no válido.</span>
</div>
