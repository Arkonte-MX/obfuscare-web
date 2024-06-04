<nav class="flex flex-row space-x-4 font-semibold">
    <a href="{{ route('inicio') }}" class="px-4 py-2 {{ (Route::currentRouteNamed('inicio') || Route::currentRouteNamed('ofuscamiento.presentar')) ? 'bg-zinc-950 rounded-md cursor-default' : 'hover:bg-zinc-700 rounded-md cursor-pointer' }}">Inicio</a>
    <a href="{{ route('informacion') }}" class="px-4 py-2 {{ Route::currentRouteNamed('informacion') ? 'bg-zinc-950 rounded-md cursor-default' : 'hover:bg-zinc-700 rounded-md cursor-pointer' }}">Ayuda</a>
    <a href="{{ route('acerca') }}" class="px-4 py-2 {{ Route::currentRouteNamed('acerca') ? 'bg-zinc-950 rounded-md cursor-default' : 'hover:bg-zinc-700 rounded-md cursor-pointer' }}">Nosotros</a>
    <x-encabezado.autenticarse></x-encabezado.autenticarse>
</nav>