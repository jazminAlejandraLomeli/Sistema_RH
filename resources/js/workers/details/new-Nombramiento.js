/*
    Script para gregar un nombramiento desde la vista de detalles,     
        segun el boton que se presione se agregar el principal o el secundario 
*/

import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "../../loading-screen.js";
import { Request_Search } from "./request/serch-distincion/search-dist.js";
import { Request_store } from "./request/new/request-add.js";
import {
    validarCampo,
    regexNumero,
    regexLetrasHorario,
    regexFecha,
    regexArea,
} from "../../helpers/generalFuntions.js";
import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";
import { Nombramiento } from "../../new-worker/validation/nombramiento-autorrellenable.js";
import { ObtenerContrato } from "../../new-worker/new-worker.js";

window.addEventListener("load", function () {
    window.id = $("#detalles-container").data("id");
    var Genero = $("#Person_sex").text().trim() === "Masculino" ? 1 : 2;

    clicPrincipal(id, Genero);
    clicSecundario(id, Genero);

    // new TomSelect("#department", {
    //     sortField: { field:button"],
    //     maxItems: 10, "text" },
    //     plugins: ["remove_
    // });
});

/* Funcion para agregar el nombramiento principal */
function clicPrincipal(id, Genero) {
    $("#N-Principal").off("click");
    $("#N-Principal").on("click", function () {
        ObtenerNombramiento(id, Genero, 1);
        $("#Principal").modal("show");
    });
}

/* Funcion para agregar el nombramiento secundario  */
function clicSecundario(id, Genero) {
    $("#N-Secundario").off("click");
    $("#N-Secundario").on("click", function () {
        ObtenerNombramiento(id, Genero, 0);
        $("#Principal").modal("show");
    });
}

/* Funcion que habilita o desabilita los inputs del formulario segun el nombramiento que se seleccione*/
async function ObtenerNombramiento(id, Genero, Tipo) {
    const resultado = await Nombramiento(Genero);

    ObtenerContrato("#new_contrato");

    FormDataJob(Tipo);
}

/* Funcion que obtiene losa datos del formulario y los valida */
function FormDataJob(Tipo) {
    $("#save-job").removeAttr("disabled");
    clicContrato();
    $("#save-job").off("click");
    $("#save-job").on("click", function () {
        var band = 0;
        // Obtener los valores
        var nombramiento = $("#nombramientos").val();
        var id_categoria = $("#categorias").val();
        var area_distincion = $("#dep").val();
        var distincion_adicional = $("#Distincion_Adicional").val();
        var horario_oficial = $("#hor_oficial").val();
        var turno = $("#shift").val();
        var tipo_contrato = $("#new_contrato").val();
        var fecha_termino = $("#fecha_termino_new").val();
        var horas_trabajo = $("#hours").val();
        const departament = $("#department").val();
        const semblanza = $("#semblanza").val();

        let validateDepartamento = true;

        //Validar los datos
        let V_nombramiento = validarCampo(
            nombramiento,
            regexNumero,
            "#nombramientos"
        );
        let V_categoria = validarCampo(
            id_categoria,
            regexNumero,
            "#categorias"
        );
        //let V_distincion = validarCampo(distincion_adicional,regexNumero,"#Distincion_Adicional");
        let V_area = validarCampo(area_distincion, regexArea, "#dep");
        let V_horas_trabajo = validarCampo(horas_trabajo, regexNumero, "#dep");
        let V_horarioOf = validarCampo(
            horario_oficial,
            regexLetrasHorario,
            "#hor_oficial"
        );

        let V_turno = validarCampo(turno, regexNumero, "#shift");

        let V_tipo = validarCampo(tipo_contrato, regexNumero, "#new_contrato");

        // Si el contrato es temporal
        if (tipo_contrato < 3) {
            let V_fechaT = validarCampo(
                fecha_termino,
                regexFecha,
                "#fecha_termino_new"
            );
            if (!V_fechaT) {
                band = 1;
            } else {
                $("#fecha_termino_new").removeClass("border border-error");
                band = 0;
            } // No puede estar vacio
        }

        let V_semblanza = true;
        // Validar si el nombramiento es profesor de asignatura validar que solamente exista al menos un departamento seleccionado
        if (V_nombramiento && nombramiento == 6) {
            const span = $(".ts-wrapper").next("span");

            if (departament.length == 0) {
                validateDepartamento = false;
                $(".ts-wrapper").addClass("border-danger");
                span.text(
                    "Debe selecciona al menos una dependencia en la que imparte clases"
                );
                span.show();
            } else {
                validateDepartamento = true;
                $(".ts-wrapper").removeClass("border-danger");
                span.hide();
            }

            if (semblanza !== "") {
                // Validar si el campo de la semblanza no esta vacio
                V_semblanza = validarCampo(semblanza, regexArea, "#semblanza");
            }
        }

        if (
            band == 0 &&
            V_nombramiento &&
            V_categoria &&
            V_area &&
            V_horarioOf &&
            V_tipo &&
            V_turno &&
            V_horas_trabajo &&
            validateDepartamento &&
            V_semblanza
        ) {
            //var Codigo = $("#Person_Code").text().trim();
            var Id = $("#detalles-container").data("id");

            let JobData = {
                Principal: Tipo,
                Id: Id,
                Adicional: distincion_adicional,
                Adscripcion: area_distincion,
                Categoria: id_categoria,
                Contrato: tipo_contrato,
                Horas: horas_trabajo,
                Nombramiento: nombramiento,
                Oficial: horario_oficial,
                Turno: turno,
                Vencimiento: fecha_termino,
                Departamentos: departament,
                Semblanza: semblanza,
            };

            AgregarPersonal(JobData);
        } else {
            Swal.fire({
                title: "¡Error!",
                text: "Parece que ingresaste un dato erróneo.",
                icon: "error",
            });
            return;
        }
    });
}

function clicContrato() {
    $("#new_contrato").on("change", function () {
        var tipo_contrato = $("#new_contrato").val();

        if (tipo_contrato < 3) {
            // Temporal
            if ($(".Contrato").hasClass("d-none")) {
                // Agregarle la propiedad si no la tiene
                $(".Contrato").removeClass("d-none");
            }
        } else {
            if (!$(".Contrato").hasClass("d-none")) {
                // Agregarle la propiedad si no la tiene
                $(".Contrato").addClass("d-none");
            }
        }
    });
}

/* Funcion para gregar un nombramiento en la parte de detalles */
async function AgregarPersonal(Job) {
    const datos = {
        Job,
    };

    try {
        const response = await Request_store(datos);
    } catch (error) {
        Swal.fire({
            title: "¡Error!",
            text: "Algo salio mal, intentalo otra vez.",
            icon: "error",
        });
    }
}
