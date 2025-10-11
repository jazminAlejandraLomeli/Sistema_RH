


import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";
import { activeLoading, disableLoading } from "../../loading-screen";

/* Peticion al controlador para eliminar a un usuario */
export async function RequestDetails(id) {
    activeLoading();
    const datos = {
        Id: id,
    };
    try {
        const response = await axios.post("/usuarios/get_details", datos);
        const { data } = response;
        disableLoading();
        return data; // Retornar los datos
    } catch (error) {
        AxiosError(error, "Hubo un problema al obtener los datos del usuario.");
        disableLoading(); // Corregir llamada a la función disableLoading
    }
}
