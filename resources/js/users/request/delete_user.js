


import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";
import { activeLoading, disableLoading } from "../../loading-screen";

/* Peticion al controlador para eliminar a un usuario */
export async function On_Off(id_usuario, Option) {
    activeLoading();
    const datos = {
        Id: id_usuario,
        Status: Option,
    };
    try {
        const response = await axios.post("/usuarios/On_Off_User", datos);
        const { data } = response;
        const { status, msg } = data;
        let timerInterval;
        disableLoading(); 
        timerInterval = AlertaSweerAlert(2500, "¡Éxito!", msg, "success", 1);        
    } catch (error) {
        AxiosError(error, "Hubo un problema al restablecer la contraseña.");
        disableLoading(); // Corregir llamada a la función disableLoading
    }
}
