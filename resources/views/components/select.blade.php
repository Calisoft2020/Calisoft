{{-- Bootstrap Select
    ** args
    items -> Icono del desplegable
    label -> Titulo del desplegable
--}}
<div class="form-group">
    <label>{{ $title }}</label>
    <select name="{{ $name }}" class="form-control">
        @foreach($items as $item)
            <option value="{{ $item[$value] }}">
                {{ $item[$label] }}
            </option>
        @endforeach
    </select>
</div>
