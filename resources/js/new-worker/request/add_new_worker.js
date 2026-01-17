import Swal, { swal } from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "../../loading-screen.js";

import { AxiosError } from "../../helpers/Alertas";
import { extractValues } from "../../helpers/form/helpers/extract-obj-values.js";

/*
    Funcion que llama al controlador para agregar un nuevo registro al sistema
*/
export async function request_insert(Personal, Address, Job) {

    activeLoading();
    // Obtener los valores no las referencias
    const datos = {
        Personal: extractValues(Personal),
        Address: extractValues(Address),
        Job: extractValues(Job),
    };
    
    try {
        const response = await axios.post("/personal/add-new-worker", datos);
        const { data } = response;
        const { status, msg } = data;

        disableLoading();

        if (status == 200) {
            Swal.fire({
                title: "!Éxito!",
                text: "Se agrego el registro correctamente. ¿Deseas agregar más registros?",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Agregar",
                cancelButtonText: "Regresar",
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                } else {
                    window.location.href = "/personal";
                }
            });
        }
    } catch (error) {
        disableLoading();
        console.log(error);
        AxiosError(
            error,
            "Algo salio mal al ingresar los datos, intentalo otra vez."
        );
    }
}
