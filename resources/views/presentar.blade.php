@php
$autenticado = Auth::check();
$cantidad_palabras = count($procesadas);
$cantidad_palabras_faltantes = 0;
$cantidad_palabras_ignoradas = 0;
$faltantes = [];
@endphp

<x-maquetado.contenedor>
    <x-slot name="contenido">
        <div id="resultado" class="flex flex-col">

            <div x-data="{ indice: null, color: null, peso: null, desplazamiento: 0 }" class="flex flex-row text-justify w-full items-center justify-center">
                @if(!!$palabras && count($procesadas) > 0)

                <div x-ref="palabras" class="p-6 grow overflow-y-auto font-light bg-zinc-800 rounded-l-lg" @scroll="desplazamiento = $refs.palabras.scrollTop; $refs.procesadas.scrollTop = desplazamiento">
                    <h4 class="text-zinc-100 text-3xl">Texto original</h4>
                    <p class="px-1 py-2 text-zinc-400 text-lg">
                        @foreach($palabras as $indice => $palabra)
                        <span :class="{ [color]: indice === {{ $indice }}, 'font-bold text-xl': indice === {{ $indice }} }">
                            {{ $palabra }}
                        </span>
                        @endforeach
                    </p>
                </div>
                <div x-ref="procesadas" class="p-6 grow overflow-y-auto bg-gradient-to-br from-rose-700 via-violet-800 to-purple-950 rounded-r-lg" @scroll="desplazamiento = $refs.procesadas.scrollTop; $refs.palabras.scrollTop = desplazamiento">
                    <div class="relative hover:cursor-pointer" @click="window.UtileriasPresentar.copiarTextoPortapapeles($refs.procesadas)">
                        <x-uni-copy-o class="absolute top-1 right-0 w-6 text-zinc-200 hover:text-yellow-300" />
                    </div>
                    <h4 class="text-zinc-50 font-light text-3xl">Texto analizado</h4>
                    <p class="px-1 py-2 text-zinc-100 text-lg font-normal">
                        @foreach($procesadas as $indice => $procesada)
                        <span x-on:mouseover="indice = {{ $indice }}; color = window.UtileriasPresentar.obtenerColorSeveridad({{ $procesada['severidad'] }}); peso = 'font-bold'" x-on:mouseout="indice = null; peso = null">
                            @if($procesada['ofuscada'] && $procesada['ofuscada'] !== "")

                            {!! ((int) $procesada['severidad'] > 0) ? "<strong><u>{$procesada['ofuscada']}</u></strong>" : "<u>{$procesada['ofuscada']}</u>" !!}

                            @else

                            <i class="text-zinc-300">{{ $procesada['original'] }}</i>

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
                        </span>
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
                        Queremos informarte que de las palabras en este texto, <strong><u> hemos modificado {{ $cantidad_palabras - ($cantidad_palabras_ignoradas + $cantidad_palabras_faltantes) }}</u></strong>.
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