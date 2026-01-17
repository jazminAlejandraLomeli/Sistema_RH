import { Validar_datos } from "../../../new-worker/validation/validate-data.js";
import { listenData } from "./show-hide-inputs.js";

/*
    Validar el obj de los datos personal y retornar true o false segun si los datos son validos
*/
export async function get_form_personal_data(persona = null, domicilio = null) {
   
    if (persona) {  // si es en datos personales
        listenData(persona.F_nacimiento, persona.F_ingreso);
    }

 
    // Esperamos clic al boton para retornar algo
    return new Promise((resolve) => {
        let Validate_data = Validar_datos(persona, domicilio);
        resolve(Validate_data);
    });
}
