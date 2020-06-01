{{-- 
    Link for sidebar
    link -> Ruta
    icon -> icono
    title -> Etiqueta a mostrar
--}}

<li class="nav-item">
    <a href="{{ $link }}" class="nav-link">
        <i class="{{ $icon }}"></i>
        <span class="title">{{ $title }}</span>
    </a>
</li>