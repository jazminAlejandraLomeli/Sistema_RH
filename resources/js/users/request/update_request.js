


import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";
import { activeLoading, disableLoading } from "../../loading-screen";


export async function requestEdit(id_usuario, Role) {
    const datos = {
        Id: id_usuario,
        UserType: Role,
    };
      try {
        const response = await axios.post("/usuarios/editar-usuario", datos);
        const { data } = response;

        const { status, msg } = data;
        let timerInterval;

        disableLoading(); // Corregir llamada a la función disableLoading
        // Modificar la verificación del estado de la respuesta
        timerInterval = AlertaSweerAlert(2500, "¡Éxito!", msg, "success", 1);        
    } catch (error) {
        AxiosError(error, "Hubo un problema al restablecer la contraseña.");
        disableLoading(); // Corregir llamada a la función disableLoading
    }
}