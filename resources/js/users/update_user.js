import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { requestEdit } from "./request/update_request.js";
 
$(function () {
    ClicUpdateUser();
});

function ClicUpdateUser() {
    $("#Update_User").off("click");
    $("#Update_User").on("click", function () {
        let IdUsuario = $("#id_user").val().trim();
        let new_Role = $("#roles").val();

        if (new_Role == "" || new_Role == null) {
            $("#roles").addClass("border border-danger");
        } else {
            $("#roles").removeClass("border border-danger");
            Swal.fire({
                title: "¿Estás seguro de actualizar el Rol del usuario?",
                text: "Sus permisos se veran modificados",
                icon: "warning",
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, confirmar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    requestEdit(IdUsuario, new_Role);
                }
            });
        }
    });
}
