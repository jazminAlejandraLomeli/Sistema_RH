import { activeLoading, disableLoading } from "../../../../loading-screen";
import { AlertaSweerAlert, AxiosError } from "../../../../helpers/Alertas";

import "sweetalert2/src/sweetalert2.scss";

/*  
    Funcion que llama al controlador para hacer la edicion de los datos 
*/
export async function EditarNombramiento(Job, Id) {
    activeLoading();
    const datos = {
        Job,
    };
    try {
        const response = await axios.put(
            "/personal/editar-Nombra/" + Id,
            datos
        );
        const { data } = response;
        const { msg } = data;
        let timerInterval;
        disableLoading(); // Corregir llamada a la función disableLoading

        timerInterval = AlertaSweerAlert(2500, "¡Éxito!", msg, "success", 1);
    } catch (error) {
        disableLoading(); // Corregir llamada a la función disableLoading
        AxiosError(error, "Hubo un problema al editar los datos.");
    }
}
