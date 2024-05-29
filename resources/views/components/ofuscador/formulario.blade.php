<form class="flex flex-col flex-grow p-8" action="{{ route('ofuscamiento.ofuscar') }}" method="POST" x-data="{ texto: '' }" x-init="texto = window.UtileriasOfuscador.obtenerValorAlmacenado(); $nextTick(() => { window.UtileriasOfuscador.mostrarCuentaPalabras($refs.contador, '', {{$minimocaracteres}}, {{$maximopalabras}}, {{$maximocaracteres}}) })">
    @csrf
    <div class="flex grow">
        <div class="flex flex-col grow">
            <x-ofuscador.campo.texto :minimocaracteres="$minimocaracteres" :maximopalabras="$maximopalabras" :maximocaracteres="$maximocaracteres"></x-ofuscador.campo.texto>
        </div>
        <div class="flex flex-col space-y-4 font-semibold">
            <x-ofuscador.boton.ofuscar :etiqueta="$etiqueta" :minimocaracteres="$minimocaracteres"></x-ofuscador.boton.ofuscar>
            <x-ofuscador.boton.limpiar :minimocaracteres="$minimocaracteres" :maximocaracteres="$maximocaracteres" :maximopalabras="$maximopalabras"></x-ofuscador.boton.limpiar>
        </div>
    </div>
    <x-ofuscador.campo.pista></x-ofuscador.campo.pista>
</form>