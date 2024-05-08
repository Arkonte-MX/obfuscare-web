@auth
<a class="px-4 py-2 bg-rose-500 rounded-md font-bold text-zinc-100" href="{{ route('autenticacion.salir') }}">
    Salir
</a>
@else
<a class="px-4 py-2 bg-rose-500 rounded-md font-bold text-zinc-100" href="{{ route('autenticacion.solicitar') }}">
    Autenticarse
</a>
@endauth