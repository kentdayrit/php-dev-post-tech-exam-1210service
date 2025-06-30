<div class="input-group mb-3">
    <span class="input-group-text">{{ $title }}</span>
    <select name="{{ $name }}" id="{{ $id }}" class="form-select">
        @if(isset($placeholder))
            <option value="" selected>{{ $placeholder }}</option>
        @endif
        @foreach($options as  $val => $label)
            <option value="{{ $val }}" {{ $value == $val ? 'selected' : null }}>{{ $label }}</option>
        @endforeach
    </select>
</div>
