import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { extractValues } from "../../../../../helpers/form/helpers/extract-obj-values";
import { activeLoading, disableLoading } from "../../../../../loading-screen";
import { AlertaSweerAlert, AxiosError } from "../../../../../helpers/Alertas";

/*
    Funcion que llama al controlador para agregar un nuevo registro al sistema
*/
export async function update_address_data(Data) {
    return new Promise(async (resolve, reject) => {
        activeLoading();

        const Address = {
            Address: extractValues(Data),
        };

        try {
            const response = await axios.put(
                "/personal/update-address",
                Address
            );
            const { status, msg } = response.data;

            disableLoading();

   

            if (status === 200) {
                AlertaSweerAlert(
                    2000,
                    "Domicilio actualizado",
                    msg,
                    "success",
                    1
                );
            } else {
                AlertaSweerAlert(
                    2000,
                    "No fue posible actualizar el domicilio",
                    "Algo salió mal, inténtalo más tarde.",
                    "error",
                    2
                );
            }

            resolve(response.data); 
        } catch (error) {
        
            AxiosError(error, "Algo salió mal, inténtalo más tarde.");
            reject(error); 
        } finally {
            disableLoading();
        }
    });
}
