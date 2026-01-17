/* Expresiones regulares para validar los datos */
export const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(.{4,})$/;
export const regexLetters = /^[a-zA-ZáÁéÉíÍóÓúÚÑñ. -]+$/;
export const regexCode = /^[0-9]{7,10}$/;
export const regexLetrasHorario = /^[a-zA-Z0-9áÁéÉíÍóÓúÚÑñ\s-:,.]+$/;
export const regexHorario = /^\d{2}:\d{2}\s-\s\d{2}:\d{2}$/;
export const regexNumero = /^(?=.*\d)/;
export const regexFecha = /^\d{4}-\d{2}-\d{2}$/;
export const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
export const regexDecimal = /^(?=.*\d)(?:\d*\.\d+|\d+)$/;
export const regexDecimal_mayor = /^(?=.*\d)(?!0*\.0*$)\d*(?:\.\d+)?$/;
export const regexTelefono = /^[0-9]{10}$/;
export const regexArea = /^[a-zA-Z0-9áÁéÉíÍóÓúÚÑñ.,()# -]+$/;
export const regexText = /^[a-zA-Z0-9áÁéÉíÍóÓúÚÑñ\s-:,.]*$/;
export const regexCP = /^[0-9]{5}$/;
export const regexNSS = /^[0-9]{11}$/;
export const regexRFC = /^([A-ZÑ&]{3,4})\d{6}([A-Z0-9]{3})$/i;

/* Funcion para validar los campos segun su contenido con la expresion Regular, y marcando el error con rojo */
export function validarCampo(valor, regex, campo) {
    if (!regex.test(valor)) {
        mostrarerr(campo);
        return false;
    } else {
        ocultarerr(campo);
        return true;
    }
}

/* mostrar el error en el span */
export function mostrarerr(campo) {
    $(campo).addClass("border border-danger");
    $(campo).next("span").show();
}

/* ocultar el error en el span */
export function ocultarerr(campo) {
    $(campo).next("span").hide(); // Oculta el siguiente elemento <span>
    $(campo).removeClass("border border-danger"); // Elimina la clase border-danger del campo
}

export function automaicScroll(campo) {
    $("html, body").animate(
        // hacer scroll hacia la seccion siguiente
        {
            scrollTop: $(campo).offset().top,
        },
        2000
    );
}

export function CalcularTiempos(fecha) {
    // Parsea la fecha de nacimiento en formato 'yyyy-mm-dd' a un objeto Date
    var fecha_1 = new Date(fecha);
    var fechaActual = new Date();
    var diffMilisegundos = fechaActual - fecha_1;

    var edad = Math.floor(diffMilisegundos / (1000 * 60 * 60 * 24 * 365.25));

    return edad;
}

export function agregarCero(num) {
    return num < 10 ? "0" + num : num;
}

// Obtener la fecha actual
var fecha = new Date();
var añoActual = fecha.getFullYear();
var mesActual = agregarCero(fecha.getMonth() + 1); // Sumamos 1 porque getMonth() devuelve el mes comenzando desde 0
var díaActual = agregarCero(fecha.getDate());
export const fechaActual = añoActual + "-" + mesActual + "-" + díaActual;
