/*
    Script para editar los datos del nombramiento principal
*/
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import {
    validarCampo,
    regexNumero,
    ocultarerr,
    mostrarerr,
    regexLetrasHorario,
    regexArea,
    regexDecimal_mayor,
    fechaActual,
    regexText,
} from "../../helpers/generalFuntions.js";
import { Request_Search } from "./request/serch-distincion/search-dist.js";
import { EditarNombramiento } from "./request/principal/update.js";
import { pantillaDistinciones } from "../templates/Distinciones.js";
import { pantillaCategorias } from "../templates/categorias.js";
import { AxiosError } from "../../helpers/Alertas.js";
import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

/* 
    Script para editar los datos del nombramiento Principal 
*/
var CateIniciales;
var TipoHoras = 0;
$(function () {
    // Crear un objeto para almacenar las categorías
    CateIniciales = generarArregloCategorias();
    InitialConfig();
    CambioNombra();

    new TomSelect("#edit_departaments", {
        sortField: { field: "text" },
        plugins: ["remove_button"],
        maxItems: 10,
    });
});

/* Funcion para determinar que input de las horas mostrar */
function InitialConfig() {
    let nombra = parseInt($("#ENombramiento").val());
    // Ocultar o mostrar la distincion al abrir el modal
    if (nombra === 4 || nombra === 5) {
        if ($(".campo_distincion").hasClass("d-none")) {
            // Agregarle la propiedad si no la tiene
            $(".campo_distincion").removeClass("d-none");
        }
    } else {
        if (!$(".campo_distincion").hasClass("d-none")) {
            // Agregarle la propiedad si no la tiene
            $(".campo_distincion").addClass("d-none");
        }
    }

    let contrato = $("#P_contrato").text();
    if (contrato === "Definitivo") {
        if (!$(".Contrato").hasClass("d-none")) {
            // Agregarle la propiedad si no la tiene
            $(".Contrato").addClass("d-none");
        }
    } else {
        if ($(".Contrato").hasClass("d-none")) {
            // Agregarle la propiedad si no la tiene
            $(".Contrato").removeClass("d-none");
        }
    }
}

/* Funcion para extraer las categorias iniciales */
function generarArregloCategorias() {
    var categorias = [];
    // Iterar sobre las opciones del select
    $("#ECategoria option").each(function () {
        var id = $(this).val();
        // Obtener el texto de la opción (nombre de la categoría) y eliminar los espacios en blanco al principio y al final
        var nombre = $(this).text().trim();
        // Agregar un objeto al array categorias con las propiedades id y nombre
        categorias.push({ id: id, nombre: nombre });
    });

    return categorias;
}

/* 
    Funcion que detecta si hubo un cambio en el nombramiento si si lo hay obtendemos las 
    nuevas categorias  y se mostraran
*/
function CambioNombra() {
    let N_actual = $("#P_nombra").data("id_nombra");
    let Genero = $("#Person_sex").text();

    $("#ENombramiento").on("change", function () {
        if (N_actual == $("#ENombramiento").val()) {
            $("#ECategoria").removeClass("border border-success");
            $("#ECategoria").val($("#id_cate").text());

            /* Mostrar las iniciales */
            pantillaCategorias("#ECategoria", CateIniciales);

            InitialConfig();
        } else {
            $("#ECategoria").addClass("border border-success");
            /* Cambio nombramiento, ir a buscar los nuevos */
            ObtenerDatos(Genero);
        }
    });

    cliccontrato();
    clicEditarPrincpal();
}

/*  Funcion para mostrar los datos segun el nombramiento */
function ObtenerDatos(Genero) {
    let Distincion = 0;
    let IdNombra = parseInt($("#ENombramiento").val());

    if (IdNombra == 6) {
        if ($(".opc").hasClass("d-none")) {
            $(".opc").removeClass("d-none");
        }
    } else if (IdNombra == 4 || IdNombra == 5) {
        Distincion = 1;

        if ($(".opc").hasClass("d-none")) {
            $(".opc").removeClass("d-none");
        }
    } else {
        if ($(".opc").hasClass("d-none")) {
            $(".opc").removeClass("d-none");
        }

        if (IdNombra == 3) {
            if ($("#EContrato").val() < 3) {
                $("#EContrato").addClass("border border-success");
                $("#Efecha_termino").addClass("border border-success");
            } else {
                $("#EContrato").removeClass("border border-success");
                $("#Efecha_termino").removeClass("border border-success");
            }
        }
    }

    var Sexo;
    if (Genero === "Masculino") {
        Sexo = 1;
    } else {
        Sexo = 2;
    }

    buscar_distincion(Sexo, IdNombra, Distincion);
}

/* Funcion que busca las distinciones segun el nombramiento */
async function buscar_distincion(Genero, id_Nombramiento, distincion) {
    const Data = {
        Id: id_Nombramiento,
        Dist: distincion,
        Genero: Genero,
    };

    try {
        const { Adicional, Categorias, status } = await Request_Search(Data);

        if (status == 200) {
            pantillaCategorias("#ECategoria", Categorias);

            if (Adicional.length === 0) {
                if (!$(".campo_distincion").hasClass("d-none")) {
                    $(".campo_distincion").addClass("d-none");
                }
            } else {
                if ($(".campo_distincion").hasClass("d-none")) {
                    $(".campo_distincion").removeClass("d-none");
                }
            }

            pantillaDistinciones("#EDistincion", Adicional);
        }
    } catch (error) {
        disableLoading();
        Swal.fire({
            title: "¡Error!",
            text: "Algo salio mal al obtener los datos, intentalo otra vez.",
            icon: "error",
        });
    }
}

/* Funcion para el clic del boton de editar del modal de editar nombramiento principal*/
function clicEditarPrincpal() {
    $("#EditPrinc").off("click");
    $("#EditPrinc").on("click", function () {
        var Id = $("#EditPrinc").data("id");

        ValidarDatos();
    });
}

/* Validar datos una vez que se presiona el boton de guardar */
function ValidarDatos() {
    let Horas;
    //Obtenemoslos Datos
    let Nom = $("#ENombramiento").val(); // horas
    let Cate = $("#ECategoria").val();
    let Area = $("#editAreaDistincion").val().trim();
    let Estado = $("#EEstado").val();
    const departament = $("#edit_departaments").val();
    let Turno = $("#Eshift").val();
    let horas_Ofi = $("#Ehor_oficial").val(); // select
    let Contrato = parseInt($("#EContrato").val());
    let Semblanza = $("#edit_semblanza").val();
    let V_Horas;

    if (TipoHoras == 0) {
        Horas = $("#Ehours").val(); // 20
        V_Horas = validarCampo(Horas, regexNumero, "#Ehours");
    } else {
        Horas = $("#Ehours_text").val().trim(); // 20
        V_Horas = validarCampo(Horas, regexDecimal_mayor, "#Ehours_text");
    }
    // NULL
    let Termino = $("#Efecha_termino").val();
    let Adicional = $("#EDistincion").val(); // lunes - viernes
    // Validacion
    let V_Nom = validarCampo(Nom, regexNumero, "#ENombramiento");
    let V_Cate = validarCampo(Cate, regexNumero, "#ECategoria");
    let V_Area = validarCampo(Area, regexArea, "#editAreaDistincion");
    let V_Estado = validarCampo(Estado, regexNumero, "#EEstado");
    let V_Turno = validarCampo(Turno, regexNumero, "#Eshift");
    let V_horas_Ofi = validarCampo(
        horas_Ofi,
        regexLetrasHorario,
        "#Ehor_oficial"
    );

    let V_Semblanza = validarCampo(Semblanza, regexText, "#edit_semblanza");

    let V_Contrato = validarCampo(Contrato, regexNumero, "#EContrato");

    let V_fecha = true;
    if (Contrato == 1) {
        if (Termino == null || Termino == "" || Termino < fechaActual) {
            mostrarerr("#Efecha_termino");
            V_fecha = false;
        } else {
            ocultarerr("#Efecha_termino");
            V_fecha = true;
        }
    }
    let validateDepartamento = false;
    // Validar si el nombramiento es profesor de asignatura validar que solamente exista al menos un departamento seleccionado
    if (V_Nom && Nom == 6) {
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
    }

    if (
        V_Area &&
        V_Cate &&
        V_Contrato &&
        V_Estado &&
        V_Horas &&
        V_Nom &&
        V_Turno &&
        V_horas_Ofi &&
        V_fecha &&
        validateDepartamento &&
        V_Semblanza
    ) {
        window.id = $("#detalles-container").data("id");
        let JobData = {
            Principal: 1,
            Id: id,
            Nombramiento: Nom,
            Categoria: Cate,
            Adscripcion: Area,
            Estado: Estado,
            Horas: Horas,
            Turno: Turno,
            Oficial: horas_Ofi,
            Adicional: Adicional ?? null,
            Contrato: Contrato,
            Termino: Termino,
            Departamentos: departament,
            Semblanza: Semblanza ?? null,
        };
        EdicionEdicionNomb(JobData, id);
    }
}

/* Funcion que muestra la fecha de termino del tipo de contrato solo si es Temporal, si es definitivo la oculta*/
function cliccontrato() {
    $("#EContrato").on("change", function () {
        let con = parseInt($("#EContrato").val());

        if (con < 3) {
            if ($(".Contrato").hasClass("d-none")) {
                $(".Contrato").removeClass("d-none");
            }
        } else {
            if (!$(".Contrato").hasClass("d-none")) {
                $(".Contrato").addClass("d-none");
            }
        }
    });
}

/*
    Funcion que pide una confirmacion para la edicion de los datos
*/
async function EdicionEdicionNomb(data, id) {
    try {
        const result = await Swal.fire({
            title: "¿Estás seguro de actualizar el nombramiento?",
            icon: "warning",
            text: "El nombramiento será modificado con estos datos.",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#007F73",
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
            cancelButtonColor: "#B04759",
        });

        if (result.isConfirmed) {
            await EditarNombramiento(data, id);
        }
    } catch (error) {
        // Manejo de errores
       
        AxiosError(
            error,
            "Algo salió mal al actualizar el dato, inténtalo nuevamente."
        );
    }
}
