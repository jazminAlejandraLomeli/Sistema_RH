import {
    validarCampo,
    regexCode,
    regexLetters,
    regexNumero,
    regexFecha,
    regexCorreo,
    fechaActual,
    regexTelefono,
    ocultarerr,
} from "../../helpers/generalFuntions";
import { AxiosError } from "../../helpers/Alertas";

/*
 Funcion para validar los datos que se ingresan en el formulario de nuevo trabajador
*/

export function Validar_datos(Data) {
    const {
        Codigo,
        Genero,
        nombre,
        f_nacimiento,
        f_ingreso,
        estudios,
        correo,
        telefono,
        nombre_e,
        parentesco,
    } = Data;
    /* Validamos los campos con su respectiva expresión regular y mandamos en id del campo por si hay error */
    let V_codigo = validarCampo(Codigo.val().trim(), regexCode, Codigo);
    let V_sex = validarCampo(Genero.val(), regexNumero, Genero);
    let V_name = validarCampo(nombre.val().trim(), regexLetters, nombre);
    let V_nacimiento = validarCampo(
        f_nacimiento.val(),
        regexFecha,
        f_nacimiento
    );
    let V_ingreso = validarCampo(f_ingreso.val(), regexFecha, f_ingreso);

    let V_grade = validarCampo(estudios.val(), regexNumero, estudios);

    let V_correo;
    // No obligatorios
    if (correo.val().trim() == "") {
        V_correo = true;
        ocultarerr(correo);
    } else {
        V_correo = validarCampo(correo.val().trim(), regexCorreo, correo);
    }
    let V_tel;
    if (telefono.val().trim() == "" || telefono.val().trim() == null) {
        V_tel = true;
        ocultarerr(telefono);
    } else {
        V_tel = validarCampo(telefono.val().trim(), regexTelefono, telefono);
    }
    let V_nombre_e;
    if (nombre_e.val().trim() == "" || nombre_e.val().trim() == null) {
        V_nombre_e = true;
        ocultarerr(nombre_e);

    } else {
        V_nombre_e = validarCampo(
            nombre_e.val().trim(),
            regexLetters,
            nombre_e
        );
    }
    let V_parentesco;
    if (parentesco.val().trim() == "" || parentesco.val().trim() == null) {
        V_parentesco = true;
        ocultarerr(parentesco);
    } else {
        V_parentesco = validarCampo(
            parentesco.val().trim(),
            regexLetters,
            parentesco
        );
    }

    /* Validar las fechas con la fecha actual */
    if (f_nacimiento.val() > fechaActual) {
        V_nacimiento = validarCampo("", regexFecha, f_nacimiento);
    }
    if (f_ingreso.val() > fechaActual) {
        V_ingreso = validarCampo("", regexFecha, f_ingreso);
    }
    /* Comparar fecha de nacimiento con fecha de ingreso */
    if (f_nacimiento.val() >= f_ingreso.val()) {
        V_nacimiento = validarCampo("", regexFecha, f_nacimiento);
        V_ingreso = validarCampo("", regexFecha, f_ingreso);
        AxiosError(
            "",
            "La fecha de nacimiento no puede ser mayor a la fecha de ingreso."
        );
    }

    if (
        V_codigo &&
        V_sex &&
        V_name &&
        V_nacimiento &&
        V_ingreso &&
        V_grade &&
        V_correo &&
        V_tel &&
        V_nombre_e &&
        V_parentesco
    ) {
        return true;
    } else {
        return false;
    }
}
