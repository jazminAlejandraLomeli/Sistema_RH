/*      
    Script para mostrar los datos con Grid.js
*/
import { activeLoading, disableLoading } from "../loading-screen.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { regexPassword, validarCampo } from "../helpers/generalFuntions.js";
import { requestVerifyPass } from "./request/request_verify_password.js";
import { requestChangePass } from "./request/request_change_password.js";
import { AxiosError } from "../helpers/Alertas.js";

const verify_btn = $("#verify_pass");
const save_btn = $("#save");
const close_btn = $("#close");
const current_password = $("#current_pass");
const new_password = $("#new_password");
const confirm_password = $("#confirm_password");

$(function () {
    clicChangeInput();
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));
    clicVerify();
    disableLoading();
});

function clicChangeInput() {
    $(".btn-show").on("click", function () {
        const $input = $(this).closest(".input-pass").find("input");
        const inputType =
            $input.attr("type") === "password" ? "text" : "password";
        $input.attr("type", inputType);
    });
}

function clicVerify() {
    verify_btn.on("click", function () {
        let current_pass = current_password.val().trim();

        let V_pass = validarCampo(
            current_pass,
            regexPassword,
            current_password
        );

        if (V_pass) {
            requestVerifyPass(current_pass).then((response) => {
                if (response === 200) {
                    stept_2();
                    clicbtnClose();
                } else if (400) {
                    AxiosError(
                        "",
                        "La contraseña ingresada NO coincide con la contraseña actual"
                    );
                }
            });
        }
    });
}

function stept_2() {
    if ($(".step2").hasClass("d-none")) {
        $(".step2").removeClass("d-none");
        $(".step1").addClass("d-none");
    }

    clicChangePassword();
}

function clicbtnClose() {
    close_btn.on("click", function () {
        if ($(".step1").hasClass("d-none")) {
            $(".step1").removeClass("d-none");
            $(".step2").addClass("d-none");
        }

        new_password.val("");
        confirm_password.val("");
        current_password.val("");
    });
}

function clicChangePassword() {
    save_btn.on("click", function () {
        let V_new = validarCampo(
            new_password.val().trim(),
            regexPassword,
            new_password
        );
        let V_confirm = validarCampo(
            confirm_password.val().trim(),
            regexPassword,
            confirm_password
        );

        if (new_password.val().trim() !== confirm_password.val().trim()) {
            Swal.fire({
                title: "Contraseña incorrecta",
                text: " Ooops! Las contraseñas no coinciden",
                icon: "error",
            });
        } else if (V_new && V_confirm) {
            Swal.fire({
                title: "¿Estás seguro de cambiar la contraseña?",
                text: "Ahora deberas iniciar sesión con la nueva contraseña",
                icon: "warning",
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, actualizar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    requestChangePass(new_password.val().trim());
                }
            });
        }
    });
}
