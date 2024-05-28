@php
$autenticado = Auth::check();
$cantidad_palabras = count($procesadas);
$cantidad_palabras_faltantes = 0;
$cantidad_palabras_ignoradas = 0;
$faltantes = [];
@endphp

<x-maquetado.contenedor>
    <x-slot name="contenido">
        <div id="resultado" class="flex flex-col pt-48">

            <div x-data="{ indice: null, color: null, peso: null, desplazamiento: 0 }" class="flex flex-row w-full items-center justify-center shadow-2xl shadow-zinc-700" x-init="window.UtileriasPresentar.definirEventoCopiar($refs.copiar, $refs.procesadas)">
                @if(!!$palabras && count($procesadas) > 0)

                <div x-ref="palabras" class="p-8 grow overflow-y-auto font-normal bg-zinc-800 rounded-l-lg" @scroll="desplazamiento = $refs.palabras.scrollTop; $refs.procesadas.scrollTop = desplazamiento">
                    <h4 class="text-zinc-100 font-light text-3xl">Texto original</h4>
                    <p class="px-1 py-2 text-zinc-400 text-lg">
                        @foreach($palabras as $indice => $palabra)
                        <span :class="{ [color]: indice === {{ $indice }}, 'font-medium text-xl': indice === {{ $indice }} }">
                            {{ $palabra }}
                        </span>
                        @endforeach
                    </p>
                </div>
                <div x-ref="procesadas" class="p-8 grow overflow-y-auto bg-gradient-to-br from-rose-700 via-violet-800 to-purple-950 rounded-r-lg" @scroll="desplazamiento = $refs.procesadas.scrollTop; $refs.palabras.scrollTop = desplazamiento">
                    <div class="relative hover:cursor-pointer">
                        <img x-ref="copiar" class="absolute top-1 right-0 w-6" src="{{ asset('/multimedia/imagen/iconos/copy-svgrepo-com.png') }}" />
                    </div>
                    <h4 class="text-zinc-50 font-light text-3xl">Texto analizado</h4>
                    <p class="px-1 py-2 text-zinc-100 text-lg font-normal">
                        @foreach($procesadas as $indice => $procesada)
                    <div x-on:mouseover="indice = {{ $indice }}; color = window.UtileriasPresentar.obtenerColorSeveridad({{ $procesada['severidad'] }}); peso = 'font-bold'" x-on:mouseout="indice = null; peso = null">
                        @if($procesada['ofuscada'] && $procesada['ofuscada'] !== "")

                        {!! ((int) $procesada['severidad'] > 0) ? "<strong><u>{$procesada['ofuscada']}</u></strong>" : "{$procesada['ofuscada']}" !!}

                        @else

                        <span class="text-zinc-300">{{ $procesada['original'] }}</span>

                        @php
                        if($procesada['ofuscada'] === null) {
                        ++$cantidad_palabras_ignoradas;
                        } else if ($procesada['ofuscada'] === "") {
                        ++$cantidad_palabras_faltantes;
                        }

                        if($autenticado) {
                        $faltantes[] = $procesada['original'];
                        }
                        @endphp

                        @endif
                    </div>
                    @endforeach
                    </p>
                </div>

                @endif
            </div>

            @php shuffle($faltantes) @endphp

            <div class="h-1/2 pt-12 font-light text-lg px-8">
                <div class="flex flex-col space-y-4 text-zinc-100">
                    <p>¡Hola!</p>
                    <p>
                        Queremos informarte que de las palabras en este texto, <strong><u> hemos analizado {{ $cantidad_palabras - ($cantidad_palabras_ignoradas + $cantidad_palabras_faltantes) }}</u></strong>.
                        @if($cantidad_palabras_ignoradas > 0 || $cantidad_palabras_faltantes > 0)
                        Lamentablemente <strong><u>{{ $cantidad_palabras_ignoradas + $cantidad_palabras_faltantes }} {{ ($cantidad_palabras_ignoradas + $cantidad_palabras_faltantes > 1) ? 'palabras no pudieron ser procesadas' : 'palabra no pudo ser procesada' }}</u></strong>

                        @auth
                        @if($cantidad_palabras_faltantes > 0)
                        (<span>{{ $cantidad_palabras_faltantes }} no se {{ ($cantidad_palabras_faltantes < 2 ) ? 'encuentra' : 'encuentran' }} en nuestra base de datos</span>).
                        <span x-data="{}" class="hover:cursor-pointer"><u @click="window.UtileriasPresentar.notificarPalabrasFaltantes({{ json_encode($faltantes) }})">Haz click aquí</u> para notificar las palabras que no fueron encontradas.</span>
                        @endif
                        @endauth

                        @endif
                    </p>
                    @guest
                    <p>
                        ¿Has considerado crear una cuenta con nosotros? Como usuario registrado,
                        disfrutarás de un límite más alto de palabras que puedes procesar por texto
                    </p>
                    @endguest
                    @if(($cantidad_palabras_faltantes + $cantidad_palabras_ignoradas) > 0)
                    <p>
                        ¡Gracias por tu comprensión y apoyo! 🙌
                    </p>
                    @else
                    <p>
                        ¡Gracias por usar nuestro servicio! 🙌
                    </p>
                    @endif
                </div>

                <ul class="p-1">
                </ul>
            </div>

        </div>
    </x-slot>
</x-maquetado.contenedor>