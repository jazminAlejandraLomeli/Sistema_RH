import Swal, { swal } from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "../../loading-screen";

import { AxiosError } from "../../helpers/Alertas";

/*
    Funcion que llama al controlador para agregar un nuevo registro al sistema
*/
export async function request_insert(Personal, Job) {
    activeLoading();
    const datos = {
        Personal,
        Job,
    };
    try {
        const response = await axios.post("/personal/guardar-Personal", datos);
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

        AxiosError(
            error,
            "Algo salio mal al ingresar los datos, intentalo otra vez."
        );
    }
}
