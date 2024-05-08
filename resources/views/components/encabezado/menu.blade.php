<nav class="flex-row space-x-4 font-semibold">
    <a href="{{ route('bienvenida.inicio') }}" class="{{ Route::currentRouteNamed('bienvenida.inicio') ? 'px-4 py-2 bg-zinc-950 rounded-md cursor-default' : 'cursor-pointer' }}">Inicio</a>
    <a href="{{ route('bienvenida.informacion') }}" class="{{ Route::currentRouteNamed('bienvenida.informacion') ? 'px-4 py-2 bg-zinc-950 rounded-md cursor-default' : 'cursor-pointer' }}">Información</a>
    <x-encabezado.autenticarse></x-encabezado.autenticarse>
</nav>