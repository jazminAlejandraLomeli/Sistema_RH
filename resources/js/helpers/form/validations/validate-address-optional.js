import { ocultarerr, regexArea, regexCP, regexNumero, regexText, validarCampo } from "../../generalFuntions.js";

export function validateAddressOptional(Domicilio) {
    const { Calle, Numero, Colonia, Municipio, Estado, CP } = Domicilio;

    // banderas
    let V_calle;
    let V_numero;
    let V_colonia;
    let V_municipio;
    let V_estado;
    let V_cp;

    if (Calle.val().trim() == "" || Calle.val().trim() == null) {
        V_calle = true;
        ocultarerr(Calle);
    } else {
        V_calle = validarCampo(Calle.val().trim(), regexText, Calle);
    }
    
    if (Numero.val().trim() == "" || Numero.val().trim() == null) {
        V_numero = true;
        ocultarerr(Numero);
    } else {
        V_numero = validarCampo(Numero.val().trim(), regexArea, Numero);
    }

    if (Colonia.val().trim() == "" || Colonia.val().trim() == null) {
        V_colonia = true;
        ocultarerr(Colonia);
    } else {
        V_colonia = validarCampo(Colonia.val().trim(), regexText, Colonia);
    }

    if (Municipio.val().trim() == "" || Municipio.val().trim() == null) {
        V_municipio = true;
        ocultarerr(Municipio);
    } else {
        V_municipio = validarCampo(
            Municipio.val().trim(),
            regexText,
            Municipio
        );
    }

    if (Estado.val() == "" || Estado.val() == null) {
        V_estado = true;
        ocultarerr(Estado);
    } else {
        V_estado = validarCampo(Estado.val().trim(), regexNumero, Estado);
    }

    if (CP.val().trim() == "" || CP.val().trim() == null) {
        V_cp = true;
        ocultarerr(CP);
    } else {
        V_cp = validarCampo(CP.val().trim(), regexCP, CP);
    }


    if (V_calle && V_numero && V_colonia && V_municipio && V_estado && V_cp) {
        return true;
    } else {
        return false;
    }
}
