import { activeLoading, disableLoading } from "../../loading-screen";

import { AxiosError } from "../../helpers/Alertas.js";

/* Funcion para verificar si el codigo que se ingreso esta disponible  */
export const request_code = async (Data) => {
    return new Promise(async (resolve, reject) => { 
        
        activeLoading();
        try {
            const response = await axios.post("/personal/searchCode", Data);
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
 