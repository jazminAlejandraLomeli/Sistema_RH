import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";
import { activeLoading, disableLoading } from "../../loading-screen";

/* Peticion al controlador para eliminar a un usuario */
export async function requestChangePass(pass) {
    activeLoading();
    const datos = {
        Contraseña: pass,
    };
    try {
        //        const response = await axios.post("/Change-password", datos);

        const response = await axios.post("/perfil/Change-password", datos);
        const { data } = response;
        let timerInterval;
        disableLoading();
        timerInterval = AlertaSweerAlert(
            4000,
            "¡Éxito!",
            "La contraseña fue actualizada con éxito",
            "success",
            1
        );
    } catch (error) {
        disableLoading();
        AxiosError(
            error,
            "Oooops¡ Algo salio mal al actualizar la contraseña."
        );
    }
}
