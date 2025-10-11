/*
    Validar los datos del formulario del los datos del nombramiento
*/

import { Request_Search } from "../../workers/details/request/serch-distincion/search-dist.js";
import { pantillaDistinciones } from "../../workers/templates/Distinciones.js";
import { pantillaCategorias } from "../../workers/templates/categorias.js";
import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";
/* Funcion que espera el cambio en el nombramiento para hacer el llenado de las categorias y de la distincion adicional */
export function Nombramiento(Genero) {

    console.log("Genero");
    console.log(Genero);
    return new Promise((resolve) => {
        // Primer cambio para await
        $("#nombramientos").off("change");
        $("#nombramientos").on("change", async function () {
            $(".form-disabled").removeAttr("disabled");

            const result = handleNombramientoChange();
            console.log(result);
            const { id_Nombramiento, Distincion } = result;

            const Data = {
                Id: id_Nombramiento,
                Dist: Distincion,
                Genero: Genero,
            };

            try {
                // Buscar las categorias y distinciones adicionales
                const { Adicional, Categorias, status } = await Request_Search(
                    Data
                );
                // Mostrar categorias esto va de cajon
                pantillaCategorias(".categorias", Categorias);

                // Mostrar distinciones adicionales en caso de que las haya
                if (Adicional.length === 0) {
                    if (!$(".campo-distincion").hasClass("d-none")) {
                        $(".campo-distincion").addClass("d-none");
                    }
                } else {
                    if ($(".campo-distincion").hasClass("d-none")) {
                        $(".campo-distincion").removeClass("d-none");
                    }
                }

                console.log($(this).val());
                if ($(this).val() == 6) {
                    $(".extras-container").removeClass("d-none");
                    $(".cont-departament").removeClass("d-none");
                    $(".instructions").text(
                        "Selecciona los departamentos a los cuales el profesor impartirá clases y escribe la semblanza del profesor en caso de ya tener una."
                    );
                    $(".cont-semblanza").removeClass("d-none");
                }

                if ($(this).val() == 4) {
                    // ptc
                    console.log("entro");
                    $(".extras-container").removeClass("d-none");
                    $(".cont-semblanza").removeClass("d-none");
                    $(".instructions").text(
                        "Escribe la semblanza del profesor en caso de ya tener una"
                    );
                }

                pantillaDistinciones(".Distincion_Adicional", Adicional);

                // Aquí puedes hacer lo que quieras con los datos si es necesario
            } catch (error) {
                AxiosError(error, "Hubo un error al cargar las categorías.");
            }

            resolve(true);
        });
    });
}

/* Funcion que segun el nombramiento autorrellena lo necesario */

function handleNombramientoChange() {
    const id_Nombramiento = $("#nombramientos").val();
    let Distincion = 0;

    if (id_Nombramiento > 3 && id_Nombramiento < 7) {
        let horas = "";
       
        Distincion = 1;

        if (id_Nombramiento == 6) {
            horas = 6;    
        } 

        $(".opc").removeClass("d-none");

        template_data({
            distincion: Distincion,
            hours: horas,
            shift: 5,
            hor_oficial: "No aplica",
            contrato: "",
            dep: "",
            categorias: "",
        });
    } else if (id_Nombramiento == 3) {
        Distincion = 0;

        template_data({
            distincion: Distincion,
            hours: 7,
            shift: 5,
            hor_oficial: "No aplica",
            contrato: 1,
            dep: "",
            categorias: "",
        });
    } else {
        Distincion = 0;

        $(".opc").removeClass("d-none");

        template_data({
            distincion: Distincion,
            hours: "",
            shift: "",
            hor_oficial: " ",
            contrato: "",
            dep: "",
            categorias: "",
        });

        $(".fecha_termino").removeClass("border border-success");
        $(".categorias").removeClass("border border-success");
        $(".dep").removeClass("border border-success");


    }

    return {
        id_Nombramiento,
        Distincion,
    };
}

/* Funcion para auto llenar los datos automaticamente  */

function template_data(data) {
    // Llenar datos automaticos
    $("#hours").val(data.hours);
    $("#shift").val(data.shift);
    $("#hor_oficial").val(data.hor_oficial);

    $("#contrato").val(data.contrato);
    $("#new_contrato").val(data.contrato);

    if (data.shift == "No aplica") {
        $(".Contrato").fadeIn(500).removeClass("d-none");
        $(".Contrato").val("");
        // Marcar campos faltantes
        $(".fecha_termino").addClass("border border-success");
        $(".dep").addClass("border border-success");
        $(".categorias").addClass("border border-success");
    }
}
