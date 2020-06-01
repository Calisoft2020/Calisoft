<div class="form-group form-md-line-input {{$errors->has($name) ? 'has-error' : ''}}">
    <div class="input-icon">
        <input {!! $attributes !!} class="form-control" id="{{ $name }}" pattern="[^=<>]{5,30}" name="{{ $name }}" type="password">
        <label for="{{$name}}" class="control-label">{{ $label }}</label>
        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
        <i class="fa fa-key"></i>
    </div>
</div>