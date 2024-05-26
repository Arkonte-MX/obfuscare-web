<x-maquetado.contenedor>
    <x-slot name="contenido">
        <div class="flex flex-col w-full items-center justify-center space-y-8 pt-32 font-light text-xl text-slate-50">

            <x-documentos.invitacion></x-documentos.invitacion>

            <div x-data="{ indice: null, mostrar: 'hidden' }" class="w-2/3 space-y-14 divide-y divide-slate-500">

                <div @click="indice = 1" class="">
                    <button class="accordion-btn">
                        <span>¿Exáctamente qué es Obfuscare?</span>
                    </button>
                    <div class="pt-4 pl-6 space-y-3 accordion-content" :class="{ [mostrar]: indice !== 1  }">
                        <p>
                            Obfuscare es una aplicación web desarrollada con tecnologías como Laravel (PHP8 + Blade + Alpine.js + Tailwind CSS) y MySQL. Esta herramienta está diseñada para analizar textos y detectar palabras que podrían generar problemas en redes sociales y plataformas de contenido digital.
                            Funciona clasificando las palabras según su nivel de riesgo y aplicando técnicas de ofuscación pertinentes.
                            El objetivo es brindar al usuario una idea clara sobre la probabilidad de que su contenido —ya sea un mensaje de texto, comentario, publicación, guión o correo electrónico— pueda ser objeto de cancelación, censura o desmonetización por el uso de ciertas palabras.
                        </p>
                        <p>
                            Después de realizar el análisis, Obfuscare muestra el texto ofuscado, ofreciendo al usuario la posibilidad de compararlo con el original y copiarlo si lo considera necesario. </p>
                    </div>
                </div>

                <div @click="indice = 2">
                    <button class="accordion-btn">
                        <span>¿Cómo funciona el sistema de severidades?</span>
                    </button>
                    <div class="pt-4 pl-6 space-y-3 accordion-content" :class="{ [mostrar]: indice !== 2  }">
                        <p>
                            Obfuscare emplea un sistema de severidades para categorizar palabras según el riesgo que representan para la desmonetización o censura en plataformas digitales y redes sociales.
                            En nuestra base de datos, cada palabra recibe un grado de severidad que oscila entre ‘Neutral’ y ‘Prohibida’.
                            Con base en esta clasificación, implementamos una variedad de estrategias de ofuscación diseñadas para mitigar el riesgo.
                            Estas estrategias abarcan desde la modificación de la acentuación de las vocales hasta la sustitución de estas por símbolos y números, o incluso la censura de la palabra.
                        </p>
                        <p>
                            De esta manera, facilitamos a los usuarios la comprensión del impacto que ciertas palabras pueden tener en la visibilidad y monetización de su contenido.
                        </p>
                    </div>
                </div>

                <div @click="indice = 3">
                    <button class="accordion-btn">
                        <span>¿Por qué hay límites en la longitud del texto?</span>
                    </button>
                    <div class="pt-4 pl-6 space-y-3 accordion-content" :class="{ [mostrar]: indice !== 3  }">
                        <p>
                            Aunque las soluciones de cómputo en la nube brindan una mayor capacidad de procesamiento y almacenamiento, el costo asociado es considerablemente más alto.
                            Hemos optado por alojar Obfuscare en un servicio de hosting web estándar, y optimizar el código para para mantener los costos operativos dentro de nuestro presupuesto.
                        </p>
                        <p>
                            Te invitamos a registrar una cuenta con nosotros. Los usuarios registrados disfrutan de límites más amplios tanto en la cantidad de palabras como en el total de caracteres que pueden analizar.
                        </p>
                    </div>
                </div>

                <div @click="indice = 4">
                    <button class="accordion-btn">
                        <span>¿Se almacenan datos personales en Obfuscare?</span>
                    </button>
                    <div class="pt-4 pl-6 space-y-4 accordion-content" :class="{ [mostrar]: indice !== 4  }">
                        <p>
                            Obfuscare almacena exclusivamente nombre y dirección de correo electrónico para propósitos de autenticación.
                            Respetamos profundamente la privacidad de nuestros usuarios, por lo que no manejamos, enviamos, procesamos ni almacenamos ningún otro dato personal.
                            La autenticación se realiza a través de OAuth con Gmail, lo cual nos permite evitar el almacenamiento de contraseñas u otra información sensible.
                        </p>
                        <p>
                            Por el momento, la autenticación con Gmail es el único método de registro que ofrecemos. Sin embargo, estamos trabajando para añadir métodos adicionales de autenticación en el futuro.
                        </p>
                    </div>
                </div>

                <div @click="indice = 5">
                    <button class="accordion-btn">
                        <span>¿Cómo puedo reportar un problema o compartir una idea?</span>
                    </button>
                    <div class="pt-4 pl-6 space-y-4 accordion-content" :class="{ [mostrar]: indice !== 5  }">
                        <p>
                            Si alguna palabra en tu texto no fue procesada adecuadamente, al registrarte encontrarás una forma de reportar las palabras que no han sido categorizadas en nuestra base de datos.
                            Además, si has encontrado algún error, estás experimentando problemas o quieres compartir alguna idea o propuesta, por favor envíanos un mensaje al correo <a href="mailto:contacto@obfuscare.com.mx"><u>contacto@obfuscare.com.mx</u></a></p>
                        </p>
                    </div>
                </div>

                <div @click="indice = 6">
                    <button class="accordion-btn">
                        <span>¿Te gustaría contribuir al proyecto?</span>
                    </button>
                    <div class="pt-4 pl-6 space-y-4 accordion-content" :class="{ [mostrar]: indice !== 6 }">
                        <p>
                            Obfuscare es un proyecto desarrollado por
                            <a href="https://www.linkedin.com/in/arkontemx/" target="_blank"><u>Jonathan Muñoz Lucas</u></a>
                            en su tiempo libre. Si tienes alguna idea o propuesta, por favor ponte en contacto enviando un correo a <a href="mailto:contacto@obfuscare.com.mx"><u>contacto@obfuscare.com.mx</u></a>
                            e intentaremos responder lo antes posible.
                        </p>
                        <p class="pt-6">
                            Si la aplicación te ha sido útil y deseas apoyar su desarrollo. En casa agradeceremos enormemente cualquier donación que puedas realizar a través de
                            <a href="http://link.mercadopago.com.mx/obfuscare" target="_blank">
                                <u>MercadoPago</u>
                            </a>
                        </p>
                        <div>
                            <div class="grid grid-cols-2 gap-4 font-light text-white text-2xl">
                                <div class="group w-full h-64 bg-cover bg-center relative">
                                    <img src="{{ asset('/multimedia/imagen/fotografia/rebeca.jpeg') }}" class="w-full h-full object-cover" />
                                    <div class="absolute flex flex-col inset-0 bg-black bg-opacity-60 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                                        <span>Rebeca</span>
                                        <span class="text-sm">(Quality Assurance Lead)</span>
                                    </div>
                                </div>
                                <div class="group w-full h-64 bg-cover bg-center relative">
                                    <img src="{{ asset('/multimedia/imagen/fotografia/floki.jpeg') }}" class="w-full h-full object-cover" />
                                    <div class="absolute flex flex-col inset-0 bg-black bg-opacity-60 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                                        <span>Floki</span>
                                        <span class="text-sm">(Business Analyst)</span>
                                    </div>
                                </div>
                                <div class="group w-full h-64 bg-cover bg-center relative">
                                    <img src="{{ asset('/multimedia/imagen/fotografia/maru.jpeg') }}" class="w-full h-full object-cover" />
                                    <div class="absolute flex flex-col inset-0 bg-black bg-opacity-60 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                                        <span>Maru</span>
                                        <span class="text-sm">(IT Support Specialist)</span>
                                    </div>
                                </div>
                                <div class="group w-full h-64 bg-cover bg-center relative">
                                    <img src="{{ asset('/multimedia/imagen/fotografia/miku.jpeg') }}" class="w-full h-full object-cover" />
                                    <div class="absolute flex flex-col inset-0 bg-black bg-opacity-60 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                                        <span>Miku</span>
                                        <span class="text-sm">(DevOps Engineer)</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>
    </x-slot>
</x-maquetado.contenedor>