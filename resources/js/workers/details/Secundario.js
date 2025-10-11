/*
    Script para editar el nombremiento secundario
*/
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "../../loading-screen.js";
import { Request_Search } from "./request/serch-distincion/search-dist.js";
import { pantillaDistinciones } from "../templates/Distinciones.js";
import { pantillaCategorias } from "../templates/categorias.js";
import { EditarNombramiento } from "./request/principal/update.js";
import {
    validarCampo,
    regexNumero,
    regexLetrasHorario,
    ocultarerr,
    mostrarerr,
    fechaActual,
    regexArea,
    regexText,
} from "../../helpers/generalFuntions.js";
import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";

var CateIniciales;
$(function () {
    CateIniciales = ArregloCategorias();
    MostrarHorasIni();
    CambioNombramiento();
});

/* 
Funcion para determinar que input de las horas mostrar 
*/
function MostrarHorasIni() {
    let nombra = parseInt($("#Nombramiento").val());

    // Ocultar o mostrar la distincion al abrir el modal
    if (nombra === 4 || nombra === 5) {
        if ($(".campo-dist").hasClass("d-none")) {
            // Agregarle la propiedad si no la tiene
            $(".campo-dist").removeClass("d-none");
        }
    } else {
        if (!$(".campo-dist").hasClass("d-none")) {
            // Agregarle la propiedad si no la tiene
            $(".campo-dist").addClass("d-none");
        }
    }

    let contrato = $("#S_contrato").text();
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
function ArregloCategorias() {
    var categorias = [];
    // Iterar sobre las opciones del select
    $("#SCategoria option").each(function () {
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
function CambioNombramiento() {
    let N_actual = $("#S_nombra").data("id_nombra");
    let Genero = $("#Person_sex").text();

    $("#Nombramiento").change(function () {
        if (N_actual == $(this).val()) {
            $("#SCategoria").removeClass("border border-success");
            $("#SCategoria").val($("#id_scate").text());
            /* Mostrar las iniciales */
            pantillaCategorias("#SCategoria", CateIniciales);

            MostrarHorasIni();
        } else {
            $("#SCategoria").addClass("border border-success");
            /* Cambio nombramiento, ir a buscar los nuevos */
            ObtenerDatos(Genero);
        }
    });
    cliccontrato();
    clicEditarPrincpal();
}

/*  Funcion para mostrar los datos segun el nombramiento */
function ObtenerDatos(Genero) {
    $("#SCategoria").addClass("border border-danger");

    let Distincion = 0;
    let IdNombra = parseInt($("#Nombramiento").val());

    if (IdNombra == 6) {
        if ($(".opc").hasClass("d-none")) {
            $(".opc").removeClass("d-none");
        }
    } else if (IdNombra == 4 || IdNombra == 5) {
        Distincion = 1;

        if ($(".opc").hasClass("d-none")) {
            $(".opc").removeClass("d-none");
        }
        // // Para el caso de IdNombra == 3, mostrar el select y ocultar el input tipo text
        // $("#Shours").removeClass("d-none");
        // $("#Shours_text").addClass("d-none");
    } else {
        // nombramiento 1, 2, 3,

        if ($(".opc").hasClass("d-none")) {
            $(".opc").removeClass("d-none");
        }

        // $("#Shours").removeClass("d-none");
        // $("#Shours_text").addClass("d-none");
        // TipoHoras = 0;

        if (IdNombra == 3) {
            if ($("#SContrato").val() == 1) {
                $("#SContrato").addClass("border border-success");
                $("#Sfecha_termino").addClass("border border-success");
            } else {
                $("#SContrato").removeClass("border border-success");
                $("#Sfecha_termino").removeClass("border border-success");
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

    /* Funcion para validar los datos */
}

// Funcion que busca las distinciones segun el nombramiento
async function buscar_distincion(Sexo, id_Nombramiento, distincion) {
    activeLoading();

    const Data = {
        Id: id_Nombramiento,
        Dist: distincion,
        Genero: Sexo,
    };

    try {
        const { Adicional, Categorias, status } = await Request_Search(Data);

        if (status == 200) {
            // Obtenemos las nuevas categorias y distinciones
            pantillaCategorias("#SCategoria", Categorias);
            // Mostrar distincion adicional
            if (Adicional.length === 0) {
                if (!$(".campo-dist").hasClass("d-none")) {
                    $(".campo-dist").addClass("d-none");
                }
            } else {
                if ($(".campo-dist").hasClass("d-none")) {
                    $(".campo-dist").removeClass("d-none");
                }
            }

            pantillaDistinciones("#SDistincion", Adicional);
        }
    } catch (error) {
        disableLoading();
        AxiosError(error, "Algo salió mal, inténtalo nuevamente.");
    }
}

/* 
    Funcion para el clic del boton de editar del modal de editar nombramiento principal
*/
function clicEditarPrincpal() {
    $("#EditSecu").off("click");
    $("#EditSecu").on("click", function () {
        var Id = $("#EditSecu").data("id");
        ValidarDatos();
    });
}

/* 
    Validar datos una vez que se presiona el boton de guardar 
*/
function ValidarDatos() {
    let Nom = $("#Nombramiento").val(); // horas
    let Cate = $("#SCategoria").val();
    let Area = $("#SAdscript").val().trim();
    let Estado = $("#SEstado").val();
    const departament = $("#second_departaments").val();

    let Adicional = $("#SDistincion").val(); // lunes - viernes
    let Turno = $("#Sshift").val();
    let Termino = $("#Sfecha_termino").val(); // lunes - viernes
    let horas_Ofi = $("#Shor_oficial").val();
    let Contrato = parseInt($("#SContrato").val());
    let Horas = $("#Shours").val(); // 20
    let Semblanza = $("#second_semblanza").val();

    // Validaciones
    let V_Horas = validarCampo(Horas, regexNumero, "#Shours");
    let V_Nom = validarCampo(Nom, regexNumero, "Nombramiento");
    let V_Cate = validarCampo(Cate, regexNumero, "#SCategoria");
    let V_Area = validarCampo(Area, regexArea, "#SAdscript");
    let V_Estado = validarCampo(Estado, regexNumero, "#SEstado");
    let V_Turno = validarCampo(Turno, regexNumero, "#Sshift");
    let V_horas_Ofi = validarCampo(
        horas_Ofi,
        regexLetrasHorario,
        "#Shor_oficial"
    );
    let V_Contrato = validarCampo(Contrato, regexNumero, "#SContrato");
    let V_Semblanza = validarCampo(Semblanza, regexText, "#second_semblanza");

    let V_fecha = true;
    if (Contrato == 1) {
        // Contrato Temporal
        if (Termino == null || Termino == "" || Termino < fechaActual) {
            mostrarerr("#Sfecha_termino");
            V_fecha = false;
        } else {
            ocultarerr("#Sfecha_termino");
            V_fecha = true;
        }
    } else {
        V_fecha = true;
    }

    let V_Adicional = false;
    if (Adicional == "" || Adicional == null) {
        V_Adicional = true;
    } else {
        V_Adicional = validarCampo(Adicional, regexNumero, "#SDistincion");
    }

    let validateDepartamento = true;
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
        V_Adicional &&
        V_Semblanza &&
        validateDepartamento
    ) {
        window.id = $("#detalles-container").data("id");
        let JobData = {
            Principal: 0,
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
            Termino: Termino ?? null,
            Departamentos: departament,
            Semblanza: Semblanza ?? null,
        };
        EdicionEdicionNomb(JobData, id);
    } else {
        return;
    }
}

/* 
Funcion que muestra la fecha de termino del tipo de contrato solo si es Temporal, si es definitivo la oculta
*/
function cliccontrato() {
    $("#SContrato").on("change", function () {
        let con = parseInt($("#SContrato").val());

        if (con < 3) {
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

/*  
    Funcion que pide una confirmacion para hacer la edicion del nombramirnto secunadrio
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
