/*
    Script para agregar a una nueva persona al sistema, se deben agregar sus datos personales y 
        ademas los datos de su nombramiento principal
*/
import Swal, { swal } from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "../loading-screen.js";
import { request_code } from "./request/search-code.js";
import { request_insert } from "./request/add_new_worker.js";
import { AxiosError } from "../helpers/Alertas.js";
import { Nombramiento } from "./validation/nombramiento-autorrellenable.js";
import { Validar_datos } from "./validation/validate-data.js";
import { Validate_Data } from "./validation/validate-job-data.js";

import {
    validarCampo,
    regexFecha,
    ocultarerr,
    mostrarerr,
    fechaActual,
    automaicScroll,
} from "../helpers/generalFuntions.js";
import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

var V_nacimiento = true;
var V_ingreso = true;
const fecha_nacimiento = $("#fecha_nacimiento");
const fecha_ingreso = $("#fecha_ingreso");

window.addEventListener("load", function () {
    disableLoading(); /// ya que se cargue todo quitar el loadin
    FormPersonalData();

    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));

    new TomSelect("#department", {
        sortField: { field: "text" },
        plugins: ["remove_button"],
        maxItems: 10,
    });
});

/* 
  Funcion para validar que las fechas ingresadas sean validas
*/
function listenData() {
    $(fecha_nacimiento).on("change", function () {
        let date = $(this).val();

        if (date > fechaActual) {
            validarCampo("", regexFecha, fecha_nacimiento);
            V_nacimiento = false;
        } else {
            // Si la fecha seleccionada es válida, oculta el mensaje de error si estaba visible
            validarCampo(date, regexFecha, "#fecha_nacimiento");
        }
    });

    $(fecha_ingreso).on("change", function () {
        let ingreso = $(this).val();

        if (ingreso > fechaActual) {
            // validarCampo("", regexFecha, "#fecha_ingreso");
            V_ingreso = false;
            mostrarerr("#fecha_ingreso");
        } else {
            ocultarerr("#fecha_ingreso");
            // Si la fecha seleccionada es válida, oculta el mensaje de error si estaba visible
            validarCampo(ingreso, regexFecha, fecha_ingreso);
        }
    });
}

/*
    Validar datos personales
*/
async function FormPersonalData() {
    listenData();
    $("#personal-data").off("click");
    $("#personal-data").on("click", function () {
        /* objeto con los inputs */
        const data = {
            Codigo: $("#codigo"),
            Genero: $("#sex"),
            nombre: $("#name_P"),
            f_nacimiento: $("#fecha_nacimiento"),
            f_ingreso: $("#fecha_ingreso"),
            estudios: $("#grade"),
            correo: $("#correo"),
            telefono: $("#tel"),
            nombre_e: $("#Emer_name"),
            parentesco: $("#parentesco"),
        };

        // Validar los datos
        let Validate_data = Validar_datos(data);

        if (Validate_data) {
            const PersonalData = {
                Codigo: $("#codigo").val().trim(),
                Genero: $("#sex").val(),
                nombre: $("#name_P").val().trim(),
                f_nacimiento: $("#fecha_nacimiento").val(),
                f_ingreso: $("#fecha_ingreso").val(),
                estudios: $("#grade").val(),
                correo: $("#correo").val().trim(),
                telefono: $("#tel").val().trim(),
                nombre_e: $("#Emer_name").val().trim(),
                parentesco: $("#parentesco").val().trim(),
            };

            SearchCode($("#codigo").val().trim(), PersonalData);
        }
    });
}
/* Funcion que valida que el codigo esta disponible una vez que de da clic al boton de siguiente, si elcodigo esi esta 
    disponible se llama a la funcion que busca el nombramiento y las distinciones
*/
async function SearchCode(codigo, PersonalData) {
    const Data = {
        Codigo: codigo,
    };

    try {
        // Verificar si el código está disponible
        const response = await request_code(Data);

        // Codigo disponible
        if (response) {
            $(".job-data").fadeIn(700).removeClass("d-none");

            const resultado = await Nombramiento(PersonalData.Genero);

            // Nombramientos y distincion
            if (resultado) {
                if (!$(".back").hasClass("d-none")) {
                    $(".back").addClass("d-none");
                }

                automaicScroll(".job-data");
                clicCancel();
                // Pasamos a la funcion de validar los datos
                Form_job_validate(PersonalData);
            }
        } else {
            $(".job-data").fadeOut(900).addClass("d-none");
        }
    } catch (error) {
        disableLoading();
        AxiosError(
            error,
            "Algo salio mal al obtener los datos, intentalo otra vez."
        );
    }
}

/* Funcion que obtiene losa datos del formulario y los valida */
function Form_job_validate(PersonalData) {
    ObtenerContrato("#contrato");
    $("#confirm-register").off("click");
    $("#confirm-register").on("click", function () {
        const job_data = Validate_Data(PersonalData);

        if (job_data != null) {
            confirm_insert(PersonalData, job_data);
        } else {
        }
    });
}
/*
    Funcion para mostrar la fecha de termino o no segun el contrato que se selccione
*/
export function ObtenerContrato(campo) {
    $(campo).on("change", function () {
        let Tipo = parseInt($(campo).val());

        if (Tipo < 3) {
            if ($(".Contrato").hasClass("d-none")) {
                // Agregarle la propiedad si no la tiene
                $(".Contrato").fadeIn(500).removeClass("d-none");
            }
        } else {
            if (!$(".Contrato").hasClass("d-none")) {
                // Agregarle la propiedad si no la tiene
                $(".Contrato").fadeOut(500).addClass("d-none");
            }
        }
    });
}

async function confirm_insert(personal, job) {
    try {
        const result = await Swal.fire({
            title: "¿Estás seguro de agregar el nuevo registro al sistema?",
            icon: "warning",
            text: "Revisa que los datos sean correctos.",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#007F73",
            confirmButtonText:'Confirmar',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: "#B04759",
        });

        if (result.isConfirmed) {
            await request_insert(personal, job);
        }
    } catch (error) {
        // Manejo de errores
        AxiosError(error, "Algo salio mal, intentalo otra vez.");
    }
}

function clicCancel() {
    $(".cancel").off("click");
    $(".cancel").on("click", function () {
        confirmar();
    });
}
/*
    Funcion que pide una confirmacion de cancelacion en caso de dar clic al boton de cancelar
*/
async function confirmar() {
    Swal.fire({
        title: "¿Estás seguro de cancelar la acción?",
        text: "Se perderán todos los cambios que haz realizado.",
        icon: "warning",
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#CE802C",
        confirmButtonText: "Si, cancelar",
        cancelButtonText: "No, seguir aqui",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/personal";
        }
    });
}
