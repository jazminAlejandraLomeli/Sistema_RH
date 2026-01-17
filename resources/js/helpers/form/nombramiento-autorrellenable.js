/*
    Validar los datos del formulario del los datos del nombramiento
*/

import { AlertaSweerAlert, AxiosError } from "../Alertas.js";

import { getContract } from "./helpers/get-type-contract.js";
import { getCategoriesByNombramiento } from "./request/search-categories.js";
import { templateCategories } from "./templates/select-categories.js";
import { templateAdditional } from "./templates/template-additional.js";
import { expandTextArea } from "./templates/text-area-auto-expand.js";

/* Funcion que espera el cambio en el nombramiento para hacer el llenado de las categorias y de la distincion adicional */
export async function eventNombramiento(Genero, id_nombramiento, job) {
    // Segun el id del select nombramiento se espera el cambio
    $(id_nombramiento).off("change");
    $(id_nombramiento).on("change", async function () {
        $(".form-disabled").removeAttr("disabled"); // habilitar campos

        handleNombramientoChange(id_nombramiento.val(), job).then((result) => {
            if (!result) return;
            const { Nombramiento, distincion } = result;

            // Ejecutar la peticion ya que handleNombramientoChange retorna los datos necesarios
            getCategoriesByNombramiento({
                Id_nombramiento: parseInt(Nombramiento),
                Distincion: parseInt(distincion),
                Genero: Genero,
            }).then((response) => {
                const { Adicional, Categorias, status } = response;

                templateCategories(job.Categoria, Categorias);

                //  Mostrar distinciones adicionales en caso de que las haya
                if (Adicional.length === 0) {
                    if (!$(".campo-distincion").hasClass("d-none")) {
                        $(".campo-distincion").addClass("d-none");
                    }
                    hideExtrasTeachers();
                } else {
                    if ($(".campo-distincion").hasClass("d-none")) {
                        $(".campo-distincion").removeClass("d-none");
                    }

                    expandTextArea(job.Semblanza);

                    // Mostrar los campos de los profesores
                    teachersExpecialidad(parseInt(Nombramiento));

                    templateAdditional(job.Adicional, Adicional);
                }

                 
            });
        });
    });
}

/* 
    Funcion que segun el nombramiento autorrellena lo necesario 
*/
async function handleNombramientoChange(id_nombramiento, inputs) {
    getContract(inputs, $(".Contrato")); // Mostrar u ocultar el campo de fecha de termino

    let Distincion = 1;
    // Caso 1: nombramiento entre 4 y 6 (PTC, TA, PA)
    if (id_nombramiento > 3 && id_nombramiento < 7) {
        Distincion = 1; // pueden tener distincione adicionale

        let val_horas = "";
        let val_shift = "";

        // PA
        if (id_nombramiento == 6) {
            val_horas = 7;
            val_shift = 5;
        }

        $(".opc").removeClass("d-none");

        template_data(
            {
                distincion: Distincion,
                hours: val_horas,
                shift: val_shift,
                hor_oficial: "No aplica",
                contrato: "",
                dep: "",
                categorias: "",
            },
            inputs
        );
    }

    // Caso 2: nombramiento 3 (DIRECTIVO)
    else if (id_nombramiento == 3) {
        Distincion = 0;

        template_data(
            {
                distincion: Distincion,
                hours: 6,
                shift: 5,
                hor_oficial: "Carga 0",
                contrato: 1,
                dep: "",
                categorias: "",
            },
            inputs
        );
    }

    // Caso 3: otros  (ADMINISTRATIVOS Y OPERATIVOS)
    else {
        Distincion = 0;

        $(".opc").removeClass("d-none");

        const { Vencimiento, Categoria, Adscripcion } = inputs;

        Vencimiento.removeClass("border border-success");
        Categoria.removeClass("border border-success");
        Adscripcion.removeClass("border border-success");

        template_data(
            {
                distincion: Distincion,
                hours: "",
                shift: "",
                hor_oficial: " ",
                contrato: "",
                fecha_termino: "",
                dep: "",
                categorias: "",
            },
            inputs
        );
    }

    return { distincion: Distincion, Nombramiento: id_nombramiento };
}

/* Funcion para auto llenar los datos automaticamente  */

function template_data(data, inputs) {
    const { hours, shift, hor_oficial, contrato } = data;

    const { Horas, Turno, Oficial, Contrato } = inputs;

    // Llenar datos automaticos con los id de los inputs
    Horas.val(hours);
    Turno.val(shift);
    Oficial.val(hor_oficial);
    $(Contrato).val(contrato);

    $("#new_contrato").val(contrato);

    if (shift == "No aplica") {
        $(".Contrato").fadeIn(500).removeClass("d-none");
        $(".Contrato").val("");
    }
}

/*
    Funcion para mostrar los campos de los profesores como departamento y semblanza
*/
function teachersExpecialidad(id_nombramiento) {
    if (id_nombramiento >= 4 && id_nombramiento <= 6) {
        if (id_nombramiento === 4) {
            // Mostrar solo la semblanza
            if ($(".extras-container").hasClass("d-none")) {
                $(".instructions").text(
                    "Escribe la semblanza del profesor en caso de ya tener una."
                );
                $(".extras-container").removeClass("d-none");
                $(".cont-semblanza").removeClass("d-none");
                $(".cont-departament").addClass("d-none");
            }
        } else if (id_nombramiento === 6) {
            // Mostrar semblanza y departamentos
            if ($(".extras-container").hasClass("d-none")) {
                $(".instructions").text(
                    "Selecciona los departamentos a los cuales el profesor impartirá clases y escribe la semblanza del profesor en caso de ya tener una."
                );
                $(".extras-container").removeClass("d-none");
                $(".cont-semblanza").removeClass("d-none");
                $(".cont-departament").removeClass("d-none");
            }
        }
    }
}

/*
    Funcion para ocultar los campos de los profesores como departamento y semblanza 
*/
function hideExtrasTeachers() {
    if (!$(".extras-container").hasClass("d-none")) {
        $(".extras-container").addClass("d-none");
        $(".cont-departament").addClass("d-none");
        $(".cont-semblanza").addClass("d-none");
    }
}
