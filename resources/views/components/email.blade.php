<div class="form-group form-md-line-input {{ $errors->has($name) ? 'has-error' : '' }}">
    <div class="input-icon">
        <input {!! $attributes !!} class="form-control" id="{{ $name }}" name="{{ $name }}"
            type="email" value="{{ $value or '' }}" maxlength="50">
        <label for="{{ $name }}" class="control-label">{{ $label }}</label>
        <span class="help-block"> {{ $errors->first($name) ?: $help }} </span>
        <i class="fa fa-envelope-o"></i>
    </div>
</div>
