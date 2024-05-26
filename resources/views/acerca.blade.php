@php
use Carbon\Carbon;
$experiencia = ceil((Carbon::now())->diffInYears(Carbon::createFromDate(2016, 11, 1))) * -1;
@endphp
<x-maquetado.contenedor>
    <x-slot name="contenido">
        <div class="flex flex-col pt-32 justify-center text-center text-zinc-100 font-light">

            <div class="flex flex-col w-full items-center mb-80">
                <h1 class="font-bold text-5xl bg-gradient-to-br from-zinc-100 to-zinc-500 text-transparent bg-clip-text pb-4">
                    ¡Hola! mi nombre es
                    <p>Jonathan Muñoz Lucas</p>
                </h1>

                <div class="flex mt-4 w-1/3 rounded-full p-3 bg-gradient-to-br from-rose-700 via-violet-800 to-purple-950" style="z-index: -1">
                    <img src="{{ asset('/multimedia/imagen/fotografia/jonathan.jpg') }}" class="rounded-full" />
                </div>

                <p class="w-3/4 mt-12 text-2xl">
                    Soy un desarrollador de GDL con más de {{ $experiencia }} años de experiencia en una amplia gama de lenguajes de programación, librerías y frameworks.
                    Mi interés por compartir las lecciones y conocimientos adquiridos a lo largo de mi carrera me ha llevado a participar de forma recurrente como ponente en <a href="https://www.talent-land.mx/" target="_blank"><i><u>Jalisco Talent Land</u></i></a>.
                    Además, en ocasiones dedico tiempo a desarrollar proyectos personales, como este sitio, para aplicar conocimientos nuevos o explorar ideas específicas.
                </p>

                <div class="w-3/4 mt-8 text-2xl">
                    Si gustas intercambiar ideas o discutir oportunidades profesionales,
                    te invito a ponerte en contacto conmigo a través de mi perfil de LinkedIn o correo electrónico.

                    <div class="flex flex-col space-y-1 mt-6">
                        <p>LinkedIn: <a href="https://www.linkedin.com/in/arkontemx/" target="_blank"><u>Jonathan Muñoz Lucas</u></a></p>
                        <p>Correo: <a href="mailto:contacto@nonathan.com.mx"><u>contacto@nonathan.com.mx</u></a></p>
                        <p>Agradezco tu interés.</p>
                    </div>

                </div>
            </div>

        </div>
    </x-slot>
</x-maquetado.contenedor>