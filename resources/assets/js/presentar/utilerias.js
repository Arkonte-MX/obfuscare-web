export const obtenerColorSeveridad = (severidad = null) => {
    switch(severidad) { // DEBE COINCIDIR CON app/Traits/HasOfuscador.php -> ofuscarPalabra
        case 4: return 'text-red-400';
        case 3: return 'text-fuchsia-400';
        case 2: return 'text-lime-400';
        case 1: return 'text-slate-50'
        default: return 'text-slate-300';
    }
}

export const copiarTextoPortapapeles = (contenedor_texto_procesadas = null) => {
    try {

        const fragmentos = contenedor_texto_procesadas.querySelectorAll('span');

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