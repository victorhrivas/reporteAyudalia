<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <p>Usuarios</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('sessions.index') }}"
       class="nav-link {{ Request::is('sessions*') ? 'active' : '' }}">
        <p>Sessions</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('reporte.index') }}"
       class="nav-link {{ Request::is('reporte*') ? 'active' : '' }}">
        <p>Generar Reporte</p>
    </a>
</li>