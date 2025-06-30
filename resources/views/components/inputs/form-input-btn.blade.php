<div class="input-group mb-3">
    <input 
        type="{{ $type }}" 
        class="form-control" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        placeholder="{{ $placeholder }}" 
        value="{{ $value }}"
    >
    <button 
        type="{{ $btnType }}" 
        class="input-group-text btn btn-primary"
    >{{ $btnLabel }}</button>
</div>    
