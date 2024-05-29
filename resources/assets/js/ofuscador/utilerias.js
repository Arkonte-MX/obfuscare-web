import { TEXTO_VACIO, LOCAL_STORAGE } from "../compartido/constantes";

export const obtenerValorAlmacenado = () => {
    const texto = localStorage.getItem(LOCAL_STORAGE.CAMPO);
    return texto || TEXTO_VACIO;
}

export const actualizarTexto = (campo, contador, minimo_caracteres, maximo_palabras, maximo_caracteres) => {
    const texto = campo.value;
    localStorage.setItem(LOCAL_STORAGE.CAMPO, texto);
    mostrarCuentaPalabras(contador, texto, minimo_caracteres, maximo_palabras, maximo_caracteres);
    return texto;
}

export const habilitarSubmit = (texto = "", minimo_caracteres = 0) => {
    return texto.trim().length >= minimo_caracteres;
}

export const limpiarCampo = (campo, contador, minimo_caracteres, maximo_palabras, maximo_caracteres) => {
    const texto = TEXTO_VACIO;
    localStorage.setItem(LOCAL_STORAGE.CAMPO, texto);
    campo.value = texto;
    mostrarCuentaPalabras(contador, texto, minimo_caracteres, maximo_palabras, maximo_caracteres);
    return texto;
}

export const mostrarCuentaPalabras = (contador, texto = "", minimo_caracteres = 0, maximo_palabras = 0, maximo_caracteres = 0) => {
    const caracteres_restantes = maximo_caracteres - texto.length

    let conteo_palabras = 0;
    let no_todo_texto_se_procesara = ". ";

    if(texto.trim() === "") {
        const almacenado = localStorage.getItem(LOCAL_STORAGE.CAMPO);
        texto = (!!almacenado)
            ? almacenado
            : "";
    }

    if (texto.trim() !== "") {
        conteo_palabras = texto.split(/\s+/).length;

        if (texto.length < minimo_caracteres) {
            no_todo_texto_se_procesara = ` <i>(se requieren mínimo <strong>${minimo_caracteres}</strong> caractéres)</i>.`;
        } else if (conteo_palabras > maximo_palabras) {
            no_todo_texto_se_procesara = ` <i>(sólo las primeras ${maximo_palabras} coincidencias serán analizadas)</i>.`;
        }
    }

    contador.innerHTML = `
        <strong>${conteo_palabras}</strong> de <strong>${maximo_palabras}</strong> palabras${no_todo_texto_se_procesara} Quedan <strong>${caracteres_restantes}</strong> caractéres
    `;
}