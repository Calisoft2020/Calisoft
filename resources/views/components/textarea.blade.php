<div class="form-group form-md-line-input {{$errors->has($name) ? 'has-error' : ''}}">
    <div class="input-icon">
        <textarea {!! $attributes !!} class="form-control" id="{{ $name }}" name="{{ $name }}"
            type="textarea" value="{{ $value or '' }}" rows="5" style="resize:none"></textarea>
        <label for="{{ $name }}" class="control-label">{{ $label }}</label>
        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
        
    </div>
</div>
