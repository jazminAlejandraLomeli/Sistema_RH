import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

import { AddressData } from "../../../../new-worker/inputs/get-inputs-personal.js";
import { get_form_personal_data } from "../../../../helpers/form/helpers/get-personal-data.js";
import { disableLoading } from "../../../../loading-screen.js";
import {
    AlertaSweerAlert,
    confirmAction,
} from "../../../../helpers/Alertas.js";
import { update_address_data } from "./request/updated-address.js";

window.addEventListener("load", function () {
    disableLoading();

    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));

    new TomSelect("#state", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc",
        },
    });

    listenButton(AddressData);
});

function listenButton(AddressData) {
    $("#address-data").off("click");
    $("#address-data").on("click", function () {
        //Se ejecula las veces que se de clic
        get_form_personal_data(null, AddressData)
            .then((reponse) => {
              

                if (reponse) {
                    Object.assign(AddressData, { Id: $("#id") });
                    Object.assign(AddressData, {
                        Id_address: $("#id_address"),
                    });
                    clic_save(AddressData);
                } else {
                    Swal.fire({
                        title: "Ooops",
                        text: "Parece que ingresaste datos erróneos",
                        icon: "error",
                        confirmButtonText: "Aceptar",
                    });
                    return;
                }
            })
            .catch((error) => console.error(error));
    });
}

/*
     Función para pedir confirmacion de la acción
*/
async function clic_save(AddressData) {
    await confirmAction(
        {
            title: "¿Estás seguro de actualizar los datos del domicilio?",
            text: "Los datos anteriores no se podrán recuperar.",
            confirmText: "Sí, actualizar",
            cancelText: "No, cancelar",
            confirmColor: "#305669",
            cancelColor: "#A72703",
        },
        async () => {
            try {
                const updated = await update_address_data(AddressData);
                const { status, msg } = updated; // datos que devolvió el backend

                console.log("Resultado:", status, msg);

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
                        1
                    );
                }
            } catch (error) {
                console.error(error);
                AlertaSweerAlert(
                    2000,
                    "Error al actualizar",
                    "Ocurrió un problema al procesar la solicitud.",
                    "error",
                    1
                );
            }
        }
    );
}
