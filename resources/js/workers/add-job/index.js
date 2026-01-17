import { validateWorkData } from "../../helpers/form/validations/validate-work-data.js";
import { disableLoading } from "../../loading-screen.js";
import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";
import { eventNombramiento } from "../../helpers/form/nombramiento-autorrellenable.js";
import { AxiosError, confirmAction } from "../../helpers/Alertas.js";
import { inputs_job } from "../../new-worker/inputs/get-inputs-job-form.js";
import { request_insert_job } from "./request/add-job-request.js";

$(function () {
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
        (el) =>
            new bootstrap.Tooltip(el, {
                html: true,
            })
    );

    disableLoading();

    new TomSelect("#department", {
        sortField: { field: "text" },
        plugins: ["remove_button"],
        maxItems: 10,
    });
    // Obtenemos el genero
    const gender = $("#person_sex").val();
    const principal = $("#principal").val();
    const id_worker = $("#detalles-container").data("id");

   
    listen_to_event(gender, id_worker, principal);
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
        .catch((error) => AxiosError(error, "Algo salio mal, intentalo otra vez."));
}

/*
    Funcion que pide una confirmacion de agregar el nombramiento
*/
async function confirm_insert(job, id_worker, principal) {
    try {
        await confirmAction(
            {
                title: "¿Estás seguro de agregar el nuevo nombramiento?",
                text: "Revisa que los datos sean correctos.",
            },
            async () => {
                await request_insert_job(job, id_worker, principal);
            }
        );
    } catch (error) {
        AxiosError(error, "Algo salio mal, intentalo otra vez.");
    }
}
