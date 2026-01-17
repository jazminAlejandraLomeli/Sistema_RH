import { AxiosError } from "../../../../../helpers/Alertas";
import { extractValues } from "../../../../../helpers/form/helpers/extract-obj-values";
import { activeLoading, disableLoading } from "../../../../../loading-screen";

const id_work = $("#id_work").val();
/* Funcion para verificar si el codigo que se ingreso esta disponible  */
export const request_updated_job = async (Data, id_worker, principal) => {
    return new Promise(async (resolve, reject) => {
        activeLoading();

        const data = {
            Job: extractValues(Data),
            Id_worker: parseInt(id_worker),
            Principal: parseInt(principal),
            Id_work: parseInt(id_work),
        };

     
        try {
            const response = await axios.put("/personal/update-job", data);
            const { status, msg } = response.data;
    

           if (status ===200) {
               resolve(msg); // <-- aquí devuelves el mensaje
           } else {
               reject(msg);
           }
        } catch (error) {
            AxiosError(error, "Algo salio mal, intentalo más tarde.");
               reject(error);
        } finally {
            disableLoading();
        }
    });
};
