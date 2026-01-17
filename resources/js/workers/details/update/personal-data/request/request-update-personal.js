import { AxiosError } from "../../../../../helpers/Alertas";
import { extractValues } from "../../../../../helpers/form/helpers/extract-obj-values";
import { activeLoading, disableLoading } from "../../../../../loading-screen";

/* Funcion para verificar si el codigo que se ingreso esta disponible  */
export const update_personal_data = async (Data) => {
    return new Promise(async (resolve, reject) => {
        activeLoading();
     
        const data = {
            Personal: extractValues(Data),
        };

     
        
        try {
            const response = await axios.put(
                "/personal/actualizar-datos",
                data
            );
            const { status, msg } = response.data;
           
            if (status == true) {
                //esta disponible
                resolve(status); // Retornamos los datos desestructurados
            } else {
                AxiosError("Algo salio mal a buscar el código.", msg);
                resolve(status); // Retornamos los datos desestructurados
            }
        } catch (error) {
            AxiosError(error, "Algo salio mal, intentalo más tarde.");
            throw error;
        } finally {
            disableLoading();
        }
    });
};
