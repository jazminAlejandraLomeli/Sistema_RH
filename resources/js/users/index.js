/*      
    Script para mostrar los datos con Grid.js
*/
import { activeLoading, disableLoading } from "../loading-screen.js";
import { initialData } from "./grid/grid_users.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import "gridjs/dist/theme/mermaid.css";

import { RequestDetails } from "./request/request_details.js";
import { requestResetPass } from "./request/reset-password-request.js";
import { On_Off } from "./request/delete_user.js";

const modal_details = new bootstrap.Modal(
    document.getElementById("Details_User")
);

const clicDetails = (id) => {
    // Abres el modal con Bootstrap
    $("#id_user").val(id);
    RequestDetails(id).then((response) => {
        showDataDetails(response.data);
    });
};

const clicDelete = (id, Option) => {
    let title_a = null;
    let text_a = null;

    if (Option === "Activo") {
        title_a = "¿Estás seguro de Activar a el usuario?";
        text_a = "El usuario podra acceder al sistema";
    } else {
        title_a = "¿Estás seguro de Inactivar a el usuario?";
        text_a = "El usuario no podra acceder al sistema";
    }

    Swal.fire({
        title: title_a,
        text: text_a,
        icon: "warning",
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, confirmar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            On_Off(id, Option);
        }
    });
};

const clicReset = (id) => {
    Swal.fire({
        title: "¿Estás seguro de restablecer la contraseña?",
        text: "El usuario ya no podra acceder con su antigua contraseña",
        icon: "warning",
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, restablecer",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            requestResetPass(id);
        }
    });
};

$(function () {
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));

    disableLoading();
    const { GridUsers } = initialData(clicDetails, clicReset, clicDelete);
});

function showDataDetails(data) {
    $("#User_name").text(data.user_name);
    $("#Status").text(data.status);
    $("#Name").text(data.name);

    $("#Role").text(data.roles[0].name);

    $("#Date_ing").text(data.Created_data);

    modal_details.show();
}
