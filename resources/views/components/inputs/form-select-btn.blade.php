<div class="input-group mb-3">
    <select name="{{ $name }}" id="{{ $id }}" class="form-select">
        @foreach($options as  $val => $label)
            <option value="{{ $val }}" {{ $value == $val ? 'selected' : null }}>{{ $label }}</option>
        @endforeach
    </select>
    <button type="{{ $btnType }}" class="input-group-text btn btn-primary">{{ $btnLabel }}</button>
</div>
