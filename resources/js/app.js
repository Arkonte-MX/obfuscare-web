import './bootstrap';
import * as CONSTANTES_COMPARTIDAS from '../assets/js/compartido/constantes';
import * as UtileriasOfuscador from '../assets/js/ofuscador/utilerias';
import * as UtileriasPresentar from '../assets/js/presentar/utilerias';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.CONSTANTES_COMPARTIDAS = CONSTANTES_COMPARTIDAS;
window.UtileriasOfuscador = UtileriasOfuscador;
window.UtileriasPresentar = UtileriasPresentar;

Alpine.start();
