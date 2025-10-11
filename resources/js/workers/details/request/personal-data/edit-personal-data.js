import { disableLoading } from "../../../../loading-screen.js";
import { AlertaSweerAlert, AxiosError } from "../../../../helpers/Alertas.js";

import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

/*
    Funcion que llama al controlador para hacer la edicion en los datos 
*/
export async function editarPersonal(Data, id) {
    try {
        console.log(Data);

        const response = await axios.put("/personal/editar-datos/" + id, Data);
        const { data } = response;
        const { status, msg } = data;
        let timerInterval;
        disableLoading(); // Corregir llamada a la función disableLoading
       
            // Modificar la verificación del estado de la respuesta
            timerInterval = AlertaSweerAlert(
                2500,
                "¡Éxito!",
                msg,
                "success",
                1
            );
      
          
    } catch (error) {
        AxiosError(error, "Hubo un problema al editar los datos.");
    }
}
