import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";
import { activeLoading, disableLoading } from "../../loading-screen";

/* Funcion para enviar los datos al controlador para agregar un nuevo usuario al sistema y asignarle su rol de una vez*/
export async function RequestAddUser(nombre, codigo, tipo) {
    activeLoading();
    const datos = {
        Name: nombre,
        Code: codigo,
        UserType: tipo,
    };

    try {
        const response = await axios.post("/usuarios/agregar-usuario", datos);
        const { data } = response;
        const { status, msg } = data;
        disableLoading();
        let timerInterval;
         timerInterval = AlertaSweerAlert(2500, "¡Éxito!", msg, "success", 1);
    } catch (error) {        
        disableLoading(); // Corregir llamada a la función disableLoading
        AxiosError(
            error,
            "Ooops! parece que el usuario no tiene un correo en el sistema."
        );
    }
}
