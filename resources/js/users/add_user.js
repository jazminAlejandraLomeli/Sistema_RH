import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "../loading-screen.js";
import {
    validarCampo,
    regexPassword,
    regexCode,
} from "../helpers/generalFuntions.js";
import { AlertaSweerAlert } from "../helpers/Alertas.js";
import { RequestCodeVerify } from "./request/search_code.js";
import { RequestAddUser } from "./request/add_user_request.js";

$(function () {
    newUser();
});

/* 
    Funcion para buscar el código del usuario que se pretende agregar, se necesita validar que este en la base de datos 
*/
function newUser() {
    closeModalAdd();
    $("#SearchCode").off("click");
    $("#SearchCode").on("click", function () {
        var username = $("#user_name").val().trim();
        /* Validamos los campos con su respectiva expresión regular y mandamos en id del campo por si hay error */
        let nombre_u = validarCampo(username, regexCode, "#user_name");

        if (nombre_u) {
            RequestCodeVerify(username).then((response) => {
                const { status, msg, code } = response;
                if (status == 200) {
                    nextStep(response);
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text: msg,
                        icon: "error",
                        confirmButtonText: "Cerrar",
                    });
                }
            });
        }
    });
}

function nextStep(data) {
    const { msg, code } = data;
     $("#paso1").addClass("d-none");
     $("#code_U").text(code);
     $("#name").text(msg);
     $(".paso2").removeClass("d-none");
     $("#save-User").removeClass("d-none");
     SaveDataNewUser(code, msg);
}

/* Funcion para cerra el modal y resetear los inputs */
function closeModalAdd() {
    $(".close_modal").off("click");
    $(".close_modal").on("click", function () {
        $("#user_name").val("");
        $("#name").val(" ");
        $("#paso1").removeClass("d-none");
        $(".paso2").addClass("d-none");
        $("#alerta").addClass("d-none");
        $("#Add-User").modal("hide");
        $("#save-User").addClass(" d-none");
    });
}


/* Validar datos del formulario */
function SaveDataNewUser(username, name) {
    closeModalAdd();
  
    $("#save-User").off("click");
    $("#save-User").on("click", function () {
        var tipoUsuario = $('input[name="Tipo_Usuario"]:checked').val();
        if (tipoUsuario != "") {
          RequestAddUser(name, username, tipoUsuario);
        }
    });
}