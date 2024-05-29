export const obtenerColorSeveridad = (severidad = null) => {
    switch(severidad) { // DEBE COINCIDIR CON app/Traits/HasOfuscador.php -> ofuscarPalabra
        case 3: return 'text-red-600';
        case 2: return 'text-orange-400';
        case 1: return 'text-yellow-400';
        case 0: return 'text-zinc-100';
        default: return 'text-zinc-400';
    }
}

export const copiarTextoPortapapeles = (contenedor_palabras_procesadas = null) => {
    try {

        const fragmentos = contenedor_palabras_procesadas.querySelectorAll('span');

        let texto = "";
        fragmentos.forEach((fragmento) => {
            texto += fragmento.innerText;
        });

        if(window?.location?.protocol === "https") {
            navigator.clipboard.writeText(texto)
        } else {
            // PARA PRUEBAS EN ENTORNO LOCAL, EL DOMINIO CUENTA CON SU CERTIFICADO CORRESPONDIENTE
            let contenedor_temporal = document.createElement('textarea');
            contenedor_temporal.textContent = texto;
            document.body.append(contenedor_temporal);
            contenedor_temporal.select();
            document.execCommand('copy');
            contenedor_temporal.style.visibility = 'hidden';
        }

    } catch(error) {
        console.error(error)
    }

}

export const notificarPalabrasFaltantes = (palabras_faltantes = []) => {
    axios.post('/notificar_palabras_faltantes', {
        faltantes: palabras_faltantes
    })
    .then(function (respuesta) {
        alert(respuesta?.data?.mensaje);
    })
    .catch(function (error) {
        console.error(error);
    });
}

export const definirEventoCopiar = (boton_copiar, contenedor_palabras_procesadas) => {
    boton_copiar.onclick = function() {
        copiarTextoPortapapeles(contenedor_palabras_procesadas);
        animarElementoConPing(boton_copiar);
    }
}

const animarElementoConPing = (elemento) => {
    elemento.classList.add('animate-ping');

    console.log('animarElementoConPing', elemento);

    setTimeout(() => {
        elemento.classList.remove('animate-ping');
    }, 600);
}