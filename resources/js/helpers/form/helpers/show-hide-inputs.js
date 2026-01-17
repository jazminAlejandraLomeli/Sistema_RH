import { fechaActual, mostrarerr, regexFecha, validarCampo } from "../../generalFuntions";

/* 
  Funcion para validar que las fechas ingresadas sean validas
*/
export function listenData(fecha_nacimiento, fecha_ingreso) {
    let V_nacimiento = false;
    let V_ingreso = false;

    $(fecha_nacimiento).on("change", function () {
        let born_date = $(this).val();

        if (born_date > fechaActual) {
            validarCampo("", regexFecha, fecha_nacimiento);
            V_nacimiento = false;
        } else {
            // Si la fecha seleccionada es válida, oculta el mensaje de error si estaba visible
            validarCampo(born_date, regexFecha, fecha_nacimiento);
        }
    });

    $(fecha_ingreso).on("change", function () {
        let ingreso = $(this).val();

        if (ingreso > fechaActual) {
            // validarCampo("", regexFecha, "#fecha_ingreso");
            V_ingreso = false;
            mostrarerr(fecha_ingreso);
        } else {
            ocultarerr(fecha_ingreso);
            // Si la fecha seleccionada es válida, oculta el mensaje de error si estaba visible
            validarCampo(ingreso, regexFecha, fecha_ingreso);
        }
    });

    if ($(fecha_ingreso).val() < $(fecha_nacimiento).val()) {
        validarCampo("", regexFecha, fecha_nacimiento);
        V_nacimiento = false;
        V_ingreso = false;
        mostrarerr(fecha_ingreso);
    } else {
        validarCampo($(fecha_ingreso).val(), regexFecha, fecha_nacimiento);
        validarCampo($(fecha_ingreso).val(), regexFecha, fecha_ingreso);
    }
}
