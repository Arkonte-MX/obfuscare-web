<div class="flex w-28 text-center">
    @auth
    <a class="grow px-4 py-2 bg-rose-500 rounded-md font-bold text-zinc-100" href="{{ route('autenticacion.salir') }}">
        Salir
    </a>
    @else
    <a class="grow px-4 py-2 bg-rose-500 rounded-md font-bold text-zinc-100" href="{{ route('autenticacion.solicitar') }}">
        Regístrate
    </a>
    @endauth
</div>