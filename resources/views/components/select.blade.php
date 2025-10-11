@php
    if ($disableIndicator) {
        $class = 'form-disabled';
    } else {
        $class = '';
    }
@endphp

<div class="form-group pt-2">
    <label for="{{ $id }}">{{ $label }} @if ($requiredIndicator)
            <span class="text-danger">*</span>
        @endif
    </label>
    <select class="form-control {{ $class }}" name="{{ $name }}" id="{{ $id }}" @if($disableIndicator) disabled @endif>  
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
    <span class="text-danger fw-normal" style="display: none;">{{ $label }} no válido.</span>
</div>
