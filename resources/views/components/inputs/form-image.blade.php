@if(isset($isDisabled)) 
    <div class="mb-3">
        <label for="formFile" class="form-label">{{ $title }}</label>
        <br>
        @if($value)
            <a href="/{{ $value }}" target="_blank" class="btn btn-primary">View Image</a>
        @else 
            <a class="btn btn-secondary">No Attached Image</a>
        @endif
        @error($name)
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
@else 
    <div class="mb-3">
        <label for="formFile" class="form-label">{{ $title }}</label>
        @if($value)
            <a href="/{{ $value}}" target="_blank" class="btn btn-sm btn-primary">View Image</a>
        @endif
        <input class="form-control" type="file" id="{{ $id }}" value="{{ $value }}" name="{{ $name }}">
        @error($name)
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
@endif