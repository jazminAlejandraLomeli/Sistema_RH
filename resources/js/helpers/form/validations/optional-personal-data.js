 import {
    ocultarerr,
    regexCorreo,
    regexLetters,
    regexNSS,
    regexRFC,
    regexTelefono,
    validarCampo,
} from "../../generalFuntions.js";
 
/*
    Funcion que valida los datos no obligatorios en domicilio
*/
export function validateOptionalPersonalData(Data) {
  
    const { Correo, Telefono, Nombre_e, Parentesco, Rfc, Nss, Tel_emer } = Data;

    // Inicializamos las variables banderas
    let V_correo;
    let V_tel;
    let V_nombre_e;
    let V_parentesco;
    let V_rfc;
    let V_nss;
    let V_tel_emer;

    // No obligatorios
    if (Correo.val().trim() == "") {
        V_correo = true;
        ocultarerr(Correo);
    } else {
        V_correo = validarCampo(Correo.val().trim(), regexCorreo, Correo);
    }

    if (Telefono.val().trim() == "" || Telefono.val().trim() == null) {
        V_tel = true;
        ocultarerr(Telefono);
    } else {
        V_tel = validarCampo(Telefono.val().trim(), regexTelefono, Telefono);
    }

    if (Nombre_e.val().trim() == "" || Nombre_e.val().trim() == null) {
        V_nombre_e = true;
        ocultarerr(Nombre_e);
    } else {
        V_nombre_e = validarCampo(
            Nombre_e.val().trim(),
            regexLetters,
            Nombre_e
        );
    }

    if (Parentesco.val().trim() == "" || Parentesco.val().trim() == null) {
        V_parentesco = true;
        ocultarerr(Parentesco);
    } else {
        V_parentesco = validarCampo(
            Parentesco.val().trim(),
            regexLetters,
            Parentesco
        );
    }

    if (Rfc.val().trim() == "" || Rfc.val().trim() == null) {
        V_rfc = true;
        ocultarerr(Rfc);
    } else {
        V_rfc = validarCampo(Rfc.val().trim(), regexRFC, Rfc);
    }

    if (Nss.val().trim() == "" || Nss.val().trim() == null) {
        V_nss = true;
        ocultarerr(Nss);
    } else {
        V_nss = validarCampo(Nss.val().trim(), regexNSS, Nss);
    }

    if (Tel_emer.val().trim() == "" || Tel_emer.val().trim() == null) {
        V_tel_emer = true;
        ocultarerr(Tel_emer);
    } else {
        V_tel_emer = validarCampo(
            Tel_emer.val().trim(),
            regexTelefono,
            Tel_emer
        );
    }

    if (
        V_correo &&
        V_tel &&
        V_nombre_e &&
        V_parentesco &&
        V_rfc &&
        V_nss &&
        V_tel_emer
    ) {
        return true;
    } else {
        return false;
    }
}
