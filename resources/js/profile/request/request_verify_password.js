import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";
import { activeLoading, disableLoading } from "../../loading-screen";

/* Peticion al controlador para eliminar a un usuario */
export async function requestVerifyPass(pass) {

    activeLoading();
    const datos = {
        Contraseña: pass,
    };
    try {
        const response = await axios.post("/perfil/Verify-password", datos);
        const { data } = response;
        disableLoading();
        return 200; // Retornar los datos
    } catch (error) {
        disableLoading(); // Siempre desactiva el loading primero

        if (error.response) {
            return 400;
        } else {
            // Error de red u otro tipo
            AxiosError("No se pudo conectar con el servidor.");
             return 404;
        }
    }
}
