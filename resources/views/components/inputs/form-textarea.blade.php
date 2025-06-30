<div class="mb-3">
    <label class="form-label">{{ $title }}</label>
    <textarea 
        class="form-control" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        rows="{{ $rows }}" 
        {{ isset($isDisabled) ? 'disabled' : '' }}
    >{{ $value }}</textarea>
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
