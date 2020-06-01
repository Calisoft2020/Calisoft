<div  class="form-group form-md-checkboxes">
    <div class="md-checkbox-inline">
        <div class="md-checkbox">

            <input class="md-check" id="{{$name}}" name="{{$name}}" type="checkbox" 
                {{ old($name) ? 'checked' : '' }}>

            <label for="{{$name}}">
                <span></span>
                <span class="check"></span>
                <span class="box"></span> {{ $label }}
            </label>

        </div>
    </div>
</div>