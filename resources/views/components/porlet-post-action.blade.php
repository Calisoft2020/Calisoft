
<button class="btn btn-circle btn-icon-only btn-default" style="border-color: {{$color or "#000000"}}"
    title="{{$title or ""}}" {!! $attributes or null !!}
    onclick="event.preventDefault(); document.getElementById('{{ $id }}').submit();">
<i style="color: {{$colorIcon or "#000000"}}" class="{{ $icon }}"></i>
</button>

<form id="{{ $id }}" action="{{ $url }}" method="POST" style="display: none" target="_blank">
    {{ csrf_field() }}
</form>