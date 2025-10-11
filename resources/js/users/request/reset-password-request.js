import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";
import { activeLoading, disableLoading } from "../../loading-screen";

/* Peticion al controlador para eliminar a un usuario */
export async function requestResetPass(id_usuario) {
    activeLoading();

    const datos = {
        Id: id_usuario,
    };

    try {
        const response = await axios.post("/usuarios/reset-password", datos);
        const { data } = response;
        const { status, msg } = data;
        let timerInterval;
        disableLoading(); // Corregir llamada a la función disableLoading
        timerInterval = AlertaSweerAlert(2500, "¡Éxito!", msg, "success", 1);
    } catch (error) {
        AxiosError(error, "Hubo un problema al restablecer la contraseña.");
        disableLoading(); // Corregir llamada a la función disableLoading
    }
}
