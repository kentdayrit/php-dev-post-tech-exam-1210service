<div class="form-outline mb-4">
    <label class="form-label">{{ $title }}</label>
    <input 
        type="{{ $type }}" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        value="{{ $value }}" 
        class="form-control form-control-lg" 
        placeholder="{{ $placeholder }}" 
        {{ isset($isDisabled) ? 'disabled' : '' }}
    />
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
