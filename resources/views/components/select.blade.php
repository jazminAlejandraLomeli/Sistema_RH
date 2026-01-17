@php
    // Determinar clases CSS
    $class = $disableIndicator ? 'form-disabled' : '';

    // Detectar si el select debe permitir selección múltiple
    $isMultiple = str_ends_with($name, '[]') || (!empty($multiple) && $multiple === true);
@endphp

<div class="form-group pt-3">
    <label for="{{ $id }}">
        {{ $label }}
        @if ($requiredIndicator)
            <span class="text-danger">*</span>
        @endif
    </label>

    <select class="form-control {{ $class }}" 
            name="{{ $name }}" 
            id="{{ $id }}"
            @if($isMultiple) multiple @endif
            @if($disableIndicator) disabled @endif>
        
        @foreach ($options as $key => $value)
            <option value="{{ $key }}"
                @if(is_array($selected))
                    {{ in_array($key, $selected) ? 'selected' : '' }}
                @else
                    {{ $selected == $key ? 'selected' : '' }}
                @endif
                @if($key === '') disabled @endif>
                {{ $value }}
            </option>
        @endforeach
    </select>

    <span class="text-danger fw-normal" style="display: none;">
        {{ $label }} no válido.
    </span>
</div>
