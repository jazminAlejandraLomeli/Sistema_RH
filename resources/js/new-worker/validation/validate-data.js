// import { validateOptionalPersonalData } from "../../forms-helpers/validations/optional-personal-data";
import { validateOptionalPersonalData } from "../../helpers/form/validations/optional-personal-data.js";
import { validateRequiredPersonalData } from "../../helpers/form/validations/required-personal-data.js";
import { validateAddressOptional } from "../../helpers/form/validations/validate-address-optional.js";

/*
 Funcion para validar los datos que se ingresan en el formulario de nuevo trabajador
*/
export function Validar_datos(Data, domicilio) {
    let data_required = true;
    let data_optional = true;
    // Si tiene datos personales
    if (Data) {
        // Validar datos obligatorios
        data_required = validateRequiredPersonalData(Data);
        // No obligatorios de datos personales
        data_optional = validateOptionalPersonalData(Data);
    }

    console.log(domicilio);
    let data_address = true;
    if (domicilio) {
        // No obligatorios de domicilio
        data_address = validateAddressOptional(domicilio);
    }

    if (data_required && data_optional && data_address) {
        return true;
    } else {
        return false;
    }
}
