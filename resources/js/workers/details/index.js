import {
    AlertaSweerAlert,
    AxiosError,
    confirmAction,
} from "../../helpers/Alertas";
import { disableLoading } from "../../loading-screen";
import { request_switch_job } from "./request/request-switch-jobs";

const btn_switch = $("#button-switch");
window.addEventListener("load", function () {
    disableLoading();
    window.id = $("#detalles-container").data("id");

    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));

 
    clicSwitch();
});
/*
    Funcion que se encarga de agregar el evento click al boton de intercambio de nombramientos
*/
function clicSwitch() {
    btn_switch.off("click");
    btn_switch.on("click", function () {
        let idWork = $(this).data("work-id");
        let idWorker = $(this).data("worker-id");
       
        confirmSwitch(idWork, idWorker);
    });
}
/*
    Funcion que confirma el intercambio de nombramientos
*/
async function confirmSwitch(idWork, id_worker) {
    try {
        await confirmAction(
            {
                title: "Intercambiar los nombramientos",
                text: "El nombramiento secundario pasará ser el principal y viceversa.",
            },
            async () => {
                try {
                    const msg = await request_switch_job(idWork, id_worker);
                   
                    AlertaSweerAlert(
                        2000,
                        "Nombramientos intercambiados",
                        msg,
                        "success",
                        0,
                        "/personal/detalles/" + id_worker
                    );
                } catch (error) {
                   
                    AxiosError(error, "Algo salió mal, inténtalo otra vez.");
                }
            }
        );
    } catch (error) {
         AxiosError(error, "Algo salió mal, inténtalo otra vez.");
    }
}
