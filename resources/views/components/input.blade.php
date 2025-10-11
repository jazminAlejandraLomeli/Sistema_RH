@php
if($disableIndicator){
 $class = 'form-disabled';
}else {
 $class = '';
}
    

@endphp

<div class="form-group pt-2">
    <label for="{{ $id }}">
        {{ $label }}
        @if ($requiredIndicator)
            <span class="text-danger fw-bold">*</span>
        @endif
    </label>
    <input  type="{{ $type }}" class="form-control {{ $class }}" id="{{ $id }}" name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $uppercase ? 'oninput=this.value=this.value.toUpperCase()' : '' }}
        @if($maxlength) maxlength="{{ $maxlength }}" @endif  @if($disableIndicator) disabled @endif>  
    <span class="text-danger fw-normal" style="display: none;">{{ $label }} no válido.</span>
</div>
