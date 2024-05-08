<x-maquetado.contenedor>
    <x-slot name="contenido">
        <div class="flex flex-col items-center justify-center space-y-8">
            <x-ofuscador.contenedor :etiqueta="'Analizar'" :minimocaracteres="$minimo_caracteres" :maximocaracteres="$maximo_caracteres" :maximopalabras="$maximo_palabras" />
        </div>
    </x-slot>
</x-maquetado.contenedor>