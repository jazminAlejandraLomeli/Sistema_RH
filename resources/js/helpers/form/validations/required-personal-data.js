import { fechaActual, regexCode, regexFecha, regexLetters, regexNumero, validarCampo } from "../../generalFuntions.js";

/*  
    Funcion que valida los datos personales obligatorios
 */ 
export function validateRequiredPersonalData(Data) {
    const { Codigo, Genero, Nombre, F_nacimiento, F_ingreso, Estudios, Status } = Data;
   

    /* Validamos los campos con su respectiva expresión regular y mandamos en id del campo por si hay error */
    let V_codigo = validarCampo(Codigo.val().trim(), regexCode, Codigo);
    let V_sex = validarCampo(Genero.val(), regexNumero, Genero);
    let V_name = validarCampo(Nombre.val().trim(), regexLetters, Nombre);
    let V_nacimiento = validarCampo(F_nacimiento.val(),regexFecha, F_nacimiento);
    let V_ingreso = validarCampo(F_ingreso.val(), regexFecha, F_ingreso);
    let V_grade = validarCampo(Estudios.val(), regexNumero, Estudios);
    let V_status = validarCampo(Status.val(), regexNumero, Status);

    /* Validar las fechas con la fecha actual */
    if (F_nacimiento.val() > fechaActual) {
        V_nacimiento = validarCampo("", regexFecha, F_nacimiento);
    }
    if (F_ingreso.val() > fechaActual) {
        V_ingreso = validarCampo("", regexFecha, F_ingreso);
    }

    if (
        V_codigo &&
        V_sex &&
        V_name &&
        V_nacimiento &&
        V_ingreso &&
        V_grade &&
        V_status
    ) {
        return true;
    } else {
        return false;
    }
}
