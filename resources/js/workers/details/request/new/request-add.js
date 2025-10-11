import { activeLoading, disableLoading } from "../../../../loading-screen";
 import "sweetalert2/src/sweetalert2.scss";
import { AlertaSweerAlert, } from "../../../../helpers/Alertas";

/* 
    Funcion para hacer el request para agregar un nombramiento 
*/

export const Request_store = async (Data) => {
    return new Promise(async (resolve, reject) => {
        activeLoading();
        try {
            const response = await axios.post("/personal/Agregar-Nom", Data);
            const { status, msg } = response.data;
            let timerInterval;

            timerInterval = AlertaSweerAlert(
                2500,
                "¡Éxito!",
                msg,
                "success",
                1
            );
        } catch (error) {
             timerInterval = AlertaSweerAlert(
                 2500,
                 "¡Error!",
                 "Oooops, algo salió mal al agregar el nombramiento.",
                 "error",
                 1
             );
            reject(error);
        } finally {
            disableLoading();
        }
    });
};
