<x-maquetado.contenedor>
    <x-slot name="contenido">
        <div class="flex flex-col pt-32">

            <div class="flex flex-col space-y-12 w-full items-center justify-center mb-80">
                <div class="text-center px-24">
                    <h1 class="font-bold text-5xl bg-gradient-to-br from-zinc-100 to-zinc-500 text-transparent bg-clip-text mb-8">
                        Tu asistente para la comunicación en línea
                    </h1>
                    <span class="font-light text-zinc-100 text-xl">
                        <strong>Obfuscare</strong> es una herramienta diseñada para creadores de contenido digital y entusiastas de las redes sociales. Su objetivo es ayudar a quienes desean saber si su contenido en texto —ya sean comentarios, publicaciones, o guiones para videos— podría estar en riesgo de ser objeto de censura o desmonetización debido a las palabras utilizadas, especialmente si se abordan temas delicados. Nuestra aplicación analiza el texto ingresado e identifica y propone diversas modificaciones a palabras clave.
                    </span>
                </div>

                <div class="flex w-2/3 justify-center">
                    <img src="{{ asset('/multimedia/imagen/logotipo/obfuscare.png') }}" style="animation: girar 180s infinite linear;" />
                </div>

                <x-documentos.invitacion></x-documentos.invitacion>

                <div class="font-light text-zinc-100 text-center text-xl px-32">
                    <p class="mb-12">
                        Para comenzar, simplemente introduce el texto que deseas analizar en el campo que encontrarás en la parte inferior de la página. Este campo recordará temporalmente el último texto que ingresaste e instantáneamente te mostrará la cantidad máxima de palabras que puedes procesar y el límite máximo de caracteres por mensaje. Considera que para proceder con el análisis, se requiere un mínimo de tres caractéres.
                    </p>
                    @auth
                    <p>
                        ¿Eres un usuario registrado? ¡Genial! Disfrutarás de límites ampliados tanto en la cantidad de palabras como en el total de caracteres. 🚀
                    </p>
                    @else
                    <p>
                        Los usuarios registrados disfrutan de límites más amplios en la cantidad de palabras y el total de caracteres. ¡Únete ahora para aprovechar Obfuscare al máximo! 🚀
                    </p>
                    @endauth
                </div>
            </div>

        </div>
        <div class="flex flex-col items-center justify-center space-y-8">
            <x-ofuscador.contenedor :etiqueta="'Analizar'" :minimocaracteres="$minimo_caracteres" :maximocaracteres="$maximo_caracteres" :maximopalabras="$maximo_palabras" />
        </div>
    </x-slot>

</x-maquetado.contenedor>