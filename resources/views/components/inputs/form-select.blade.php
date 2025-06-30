<div class="form-outline mb-4">
    <label class="form-label">{{ $title }}</label>
    <select 
        name="{{ $name}}" 
        id="{{ $id }}"
        class="form-select" 
        {{ isset($isDisabled) ? 'disabled' : '' }}
    >
        @foreach($options as  $val => $label)
            <option value="{{ $val }}" {{ $value == $val ? 'selected' : null }}>{{ $label }}</option>
        @endforeach
    </select>
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
