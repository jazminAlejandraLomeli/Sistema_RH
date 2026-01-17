import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

import { disableLoading } from "../../../../loading-screen";
import { eventNombramiento } from "../../../../helpers/form/nombramiento-autorrellenable";
import { inputs_job } from "../../../../new-worker/inputs/get-inputs-job-form";
import { validateWorkData } from "../../../../helpers/form/validations/validate-work-data";
import {
    AlertaSweerAlert,
    AxiosError,
    confirmAction,
} from "../../../../helpers/Alertas";
import { initTextArea } from "../../../../helpers/form/templates/text-area-auto-expand";
import { request_updated_job } from "./request/request-update-job";
import { request_delete_job } from "./request/delete-job-request";

const del_button = $("#delete-job");

$(function () {
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));
    disableLoading();

    new TomSelect("#department", {
        sortField: { field: "text" },
        plugins: ["remove_button"],
        maxItems: 10,
    });
    // Obtenemos el genero
    const gender = $("#person_sex").val();
    const id_worker = $("#id-worker").val();
    const Principal = $("#principal").val();

    const { Semblanza, Oficial } = inputs_job;

    initTextArea(Semblanza);
    initTextArea(Oficial);

    listen_to_event(gender, id_worker, Principal);

    clicDelete(Principal, id_worker);
});

/*
    Funcion que escucha el evento del nombramiento
*/
function listen_to_event(gender, id_worker, principal) {
    const { Nombramiento } = inputs_job;

    eventNombramiento(gender, Nombramiento, inputs_job)
        .then((reponse) => {
            $("#confirm-register").off("click");
            $("#confirm-register").on("click", function () {
                if (validateWorkData(inputs_job)) {
                    confirm_insert(inputs_job, id_worker, principal);
                } else {
                    AxiosError(
                        "Error",
                        "Parece que ingresaste un dato incorrecto o vacio."
                    );
                }
            });
        })
        .catch((error) =>
            AxiosError(error, "Algo salio mal, intentalo otra vez.")
        );
}

/*
    Función que pide una confirmación para agregar el nombramiento
*/
async function confirm_insert(job, id_worker, principal) {
    try {
        await confirmAction(
            {
                title: "¿Estás seguro de actualizar el nombramiento?",
                text: "Revisa que los datos sean correctos.",
            },
            async () => {
                try {
                    const msg = await request_updated_job(
                        job,
                        id_worker,
                        principal
                    );
 
                    // Mostrar alerta de éxito con el mensaje devuelto
                    AlertaSweerAlert(
                        2000,
                        "Nombramiento actualizado",
                        msg,
                        "success",
                        1,
                        "/personal/detalles/ " + id_worker
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
/*
    Función que escucha el evento de eliminar el nombramiento
*/
function clicDelete(principal, id_worker) {
    del_button.off("click");
    del_button.on("click", function () {
        let idWork = $(this).data("id-work");
        
        confirmDeletee(principal, idWork, id_worker);
    });
}


/*
    Función que pide una confirmación para eliminar el nombramiento
*/
async function confirmDeletee(principal, idWork, id_worker) {
    let msg = "";
    let title = "";
    if (principal == 0) {
        title = "Eliminar nombramiento secundario";
        msg = "Se eliminará el nombramiento secundario.";
    } else {
        // Principal
        title = "Eliminar nombramiento principal";
        msg =
            "En caso de tener dos nombramientos el secundario pasara a ser el principal.";
    }
    try {
        await confirmAction(
            {
                title: title,
                text: msg,
            },
            async () => {
                try {
                    const msg = await request_delete_job(
                        principal,
                        idWork,
                        id_worker
                    );
 
                    // Mostrar alerta de éxito con el mensaje devuelto
                    AlertaSweerAlert(
                        2000,
                        "Nombramiento eliminado",
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
