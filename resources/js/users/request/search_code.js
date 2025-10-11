import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";
import { activeLoading, disableLoading } from "../../loading-screen";


/* Funcion  para verificar que el codigo si este en la base de datos*/
export async function RequestCodeVerify(code) {
    activeLoading();
    const datos = {
        code,
    };
    try {
        const response = await axios.post("/usuarios/verificar-codigo", datos);
        const { data } = response;
        const { status, msg, code } = data;
       
        disableLoading();
        return data; // Retornar los datos
    } catch (error) {
        disableLoading(); 
         AxiosError(error, "Hubo un problema al buscar el código en el servidor.");
    }
    
}