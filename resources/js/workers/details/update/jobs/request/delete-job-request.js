import { AxiosError } from "../../../../../helpers/Alertas";
import { activeLoading, disableLoading } from "../../../../../loading-screen";

/* Funcion para verificar si el codigo que se ingreso esta disponible  */
export const request_delete_job = async (Principal, Id_work, Id_Worker) => {
    return new Promise(async (resolve, reject) => {
        activeLoading();

        const data = {
            Principal: parseInt(Principal),
            Id_work: parseInt(Id_work),
            Id_worker: parseInt(Id_Worker),
        };

      
        try {
            const response = await axios.put("/personal/delete-job", data);
            const { status, msg } = response.data;

          

            if (status === 200) {
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
