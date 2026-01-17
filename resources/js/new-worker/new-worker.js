/*
    Script para agregar a una nueva persona al sistema, se deben agregar sus datos personales y 
        ademas los datos de su nombramiento principal
*/
import Swal, { swal } from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

import { activeLoading, disableLoading } from "../loading-screen.js";
import { automaicScroll } from "../helpers/generalFuntions.js";

import { request_insert } from "./request/add_new_worker.js";
import { AxiosError, confirmAction } from "../helpers/Alertas.js";
import { eventNombramiento } from "../helpers/form/nombramiento-autorrellenable.js";

import { get_form_personal_data } from "../helpers/form/helpers/get-personal-data.js";
import { SearchCode } from "../helpers/form/request/available-code.js";
import { validateWorkData } from "../helpers/form/validations/validate-work-data.js";
// INPUTS DEL FORMULARIO DE NOMBRAMIENTO
import { inputs_job } from "./inputs/get-inputs-job-form.js";
import { AddressData, PersonalData } from "./inputs/get-inputs-personal.js";
import { expandTextArea } from "../helpers/form/templates/text-area-auto-expand.js";
import { clearForm } from "../helpers/form/helpers/extract-obj-values.js";

window.addEventListener("load", function () {
    disableLoading(); /// ya que se cargue todo quitar el loadin.

    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
        (el) =>
            new bootstrap.Tooltip(el, {
                html: true,  
            })
    );

    new TomSelect("#department", {
        sortField: { field: "text" },
        plugins: ["remove_button"],
        maxItems: 10,
    });

    new TomSelect("#state", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc",
        },
    });

    $("#status").val(1); // estado por defecto

    listenButton(PersonalData, AddressData);
    clicClear();
    clicBack();
});

/* 
    Esperar el clic del boton de sigui
*/
function listenButton(PersonalData, AddressData) {
    $("#personal-data").off("click");
    $("#personal-data").on("click", function () {
        // Se ejecula las veces que se de clic
        get_form_personal_data(PersonalData, AddressData)
            .then((reponse) => {
                if (reponse) {
                    const { Codigo } = PersonalData;

                    SearchCode(Codigo.val()).then((avaliable) => {
                        // Verificar si el codigo esta disponible

                        if (avaliable) {
                            showSteptTwo(PersonalData, AddressData);
                        } else {
                            return;
                        }
                    });
                } else {
                    return;
                }
            })
            .catch((error) => console.error(error));
    });
}

/*
    Funcion que muestra el formualrio de los datos del nombramiento.
    Para este paso el CODIGO esta disponible y los datos personales estan validados
*/
function showSteptTwo(PersonalData, AddressData) {
    // Show next step
    $(".job-data").fadeIn(700).removeClass("d-none");
    automaicScroll(".job-data");
    expandTextArea(PersonalData.Oficial);
    Form_job_validate(PersonalData, AddressData);
}

/* Funcion que obtiene losa datos del formulario y los valida */
function Form_job_validate(PersonalData, AddressData) {
    const { Genero } = PersonalData;

    const { Nombramiento } = inputs_job;

    eventNombramiento(Genero.val(), Nombramiento, inputs_job)
        .then((reponse) => {
            $("#confirm-register").off("click");
            $("#confirm-register").on("click", function () {
                if (validateWorkData(inputs_job)) {
                    confirm_insert(PersonalData, AddressData, inputs_job);
                } else {
                    AxiosError(
                        "Error",
                        "Parece que ingresaste un dato incorrecto o vacio."
                    );
                }
            });
        })
        .catch((error) => console.error(error));
}

/*
    Funcion que pide una confirmacion de agregar el registro al sistema
*/
async function confirm_insert(personal, address, job) {
    try {
        await confirmAction(
            {
                title: "¿Estás seguro de agregar el nuevo registro al sistema?",
                text: "Revisa que los datos sean correctos.",
            },
            async () => {
                await request_insert(personal, address, job);
            }
        );
    } catch (error) {
        console.error(error);
        AxiosError(error, "Algo salio mal, intentalo otra vez.");
    }
}

function clicClear() {
    $("#button-clear").off("click");
    $("#button-clear").on("click", function () {
        confirmar();
    });
}

function clicBack() {
    $(".class-button-back").off("click");
    $(".class-button-back").on("click", function () {
        back();
    });
}

/*
    Funcion que pide una confirmacion de cancelacion en caso de dar clic al boton de cancelar
*/
async function confirmar() {
    Swal.fire({
        title: "¿Estás seguro de limpiar el formulario?",
        text: "Se perderán los datos que haz ingresado.",
        icon: "warning",
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: "#A72703",
        cancelButtonColor: "#CE802C",
        confirmButtonText: "Si, limpiar",
        cancelButtonText: "No, cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            // limpiar formulario
            clearForm(PersonalData);
            clearForm(AddressData);

            //window.location.href = "/personal";
        }
    });
}

async function back() {
    Swal.fire({
        title: "¿Estás seguro de regresar?",
        text: "Se perderán los datos que haz ingresado.",
        icon: "warning",
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: "#A72703 ",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si, regresar",
        cancelButtonText: "No, continuar",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/personal";
        }
    });
}
