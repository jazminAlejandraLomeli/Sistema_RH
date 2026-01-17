import Swal, { swal } from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
 import { activeLoading, disableLoading } from "../../../loading-screen";
import { AxiosError } from "../../../helpers/Alertas";
import { extractValues } from "../../../helpers/form/helpers/extract-obj-values.js";
 
/*
    Funcion que llama al controlador para agregar un nuevo registro al sistema
*/
export async function request_insert_job(Job, id_worker, principal) {

    activeLoading();
    // Obtener los valores no las referencias
    const datos = {
        Id: id_worker,
        Job: extractValues(Job),
        principal: parseInt(principal),
    };
    try {
        const response = await axios.post("/personal/Agregar-Nom", datos);
        const { data } = response;
        const { status, msg } = data;

        disableLoading();

        if (status == 200) {
             Swal.fire({
                 title: "¡Éxito!",
                 text: msg,
                 icon: "success",
                 confirmButtonText: "Cerrar",
             }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/personal/detalles/" + id_worker;
                }
             });
        }
    } catch (error) {
        disableLoading();
         
        AxiosError(
            error,
            "Algo salio mal al ingresar los datos, intentalo otra vez."
        );
    }
}
