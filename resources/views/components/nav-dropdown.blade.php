{{-- Dropdown link for nav sidebar
    ** args
    icon -> Icono del desplegable
    title -> Titulo del desplegable
--}}

<li class="nav-item dropdown">
    <a href="#" class="nav-link nav-toggle">
        <i class="{{ $icon }}"></i>
        <span class="title">{{ $title }}</span>
        <span class="arrow dropdown"></span>
    </a>
    <ul class="sub-menu">

        {{ $slot }}
    
    </ul>
</li>