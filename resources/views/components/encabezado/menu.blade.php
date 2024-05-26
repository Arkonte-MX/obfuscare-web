<nav class="flex flex-row space-x-6 items-center font-semibold">
    <a href="{{ route('inicio') }}" class="{{ (Route::currentRouteNamed('inicio') || Route::currentRouteNamed('ofuscamiento.presentar')) ? 'px-4 py-2 bg-zinc-950 rounded-md cursor-default' : 'cursor-pointer' }}">Inicio</a>
    <a href="{{ route('informacion') }}" class="{{ Route::currentRouteNamed('informacion') ? 'px-4 py-2 bg-zinc-950 rounded-md cursor-default' : 'cursor-pointer' }}">Información</a>
    <a href="{{ route('acerca') }}" class="{{ Route::currentRouteNamed('acerca') ? 'px-4 py-2 bg-zinc-950 rounded-md cursor-default' : 'cursor-pointer' }}">Acerca de</a>
    <x-encabezado.autenticarse></x-encabezado.autenticarse>
</nav>