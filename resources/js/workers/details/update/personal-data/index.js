import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { AlertaSweerAlert, AxiosError, confirmAction } from "../../../../helpers/Alertas";

import { get_form_personal_data } from "../../../../helpers/form/helpers/get-personal-data";
import { disableLoading } from "../../../../loading-screen";
import { PersonalData } from "../../../../new-worker/inputs/get-inputs-personal";
import { update_personal_data } from "./request/request-update-personal";

window.addEventListener("load", function () {
    disableLoading();
    const id = $("#id").val();

    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));

    listenButton(PersonalData, id);
});

function listenButton(PersonalData, id) {
    $("#personal-data").off("click");
    $("#personal-data").on("click", function () {
        // Se ejecula las veces que se de clic
        get_form_personal_data(PersonalData)
            .then((reponse) => {
                if (reponse) {
                    //   Agregamos el id
                    Object.assign(PersonalData, { Id: parseInt(id) });

                    clic_save(PersonalData);
                } else {
                    Swal.fire({
                        title: "Ooops",
                        text: "Paraece que ingresaste datos erróneos",
                        icon: "error",
                        confirmButtonText: "Aceptar",
                    });
                    return;
                }
            })
            .catch((error) => AxiosError(error, "Algo salió mal, inténtalo otra vez."));
    });
}

/*
     Función para pedir confirmacion de la acción
*/
async function clic_save(PersonalData) {
    await confirmAction(
        {
            title: "¿Estás seguro de actualizar los datos personales?",
            text: "Los datos anteriores no se podrán recuperar.",
            confirmText: "Sí, actualizar",
            cancelText: "No, cancelar",
            confirmColor: "#305669",
            cancelColor: "#A72703",
        },
        async () => {
            const available = await update_personal_data(PersonalData);

            if (available) {
                AlertaSweerAlert(
                    2000,
                    "Datos actualizados",
                    "Los datos personales se actualizaron correctamente.",
                    "success",
                    1
                );
            }
        }
    );
}
