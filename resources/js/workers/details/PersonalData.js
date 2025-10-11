/*
    Script para editar los datos personales de algun registro de personal
*/
import { activeLoading, disableLoading } from "../../loading-screen.js";
import { editarPersonal } from "./request/personal-data/edit-personal-data.js";
import { searchCode } from "./request/serch-code.js";
import {
    validarCampo,
    regexCode,
    regexLetters,
    regexNumero,
    regexFecha,
    regexCorreo,
    ocultarerr,
    mostrarerr,
    CalcularTiempos,
    fechaActual,
    regexTelefono,
} from "../../helpers/generalFuntions.js";

import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";

window.addEventListener("load", function () {
     disableLoading();
    window.id = $("#detalles-container").data("id");
    ClicEditData(id);

    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));
});

/*
    Funcion para validar los datos del modal de editar los datos personales 
*/
function ClicEditData(id) {
    $("#botonEditar").off("click");
    $("#botonEditar").on("click", function () {
        var codigo = $("#Person_Code").text().trim();
        listenEvents(codigo);
        ClicValidarDatos(id);
        cerraModal(id);
    });
}

function cerraModal(id) {
    //cerrar_modal
    $("#cerrar_modal").off("click");
    $("#cerrar_modal").on("click", function () {
        ClicEditData(id);
    });
}

/* 
    Funcion para calcular la edad y la antiguedad en caso de que en el  modal de editar se cambie alguno de estos 2 campos 
    ademas de verificar si el código se modifica verificar que no choque con otro 
*/
function listenEvents(code) {
    $("#editFechaNacimiento").on("change", function () {
        let date = $("#editFechaNacimiento").val();

        if (date > fechaActual) {
            validarCampo("", regexFecha, "#editFechaNacimiento");
            $("#modal_edad").text("-");
        } else {
            validarCampo(date, regexFecha, "#editFechaNacimiento");
            var edad = CalcularTiempos(date);
            $("#modal_edad").text(edad);
        }
    });

    $("#editFechaIngreso").on("change", function () {
        let newDate = $("#editFechaIngreso").val();

        if (newDate > fechaActual) {
            validarCampo("", regexFecha, "#editFechaIngreso");
            $("#modal_ant").text("-");
        } else {
            validarCampo(newDate, regexFecha, "#editFechaIngreso");
            var antiguedad = CalcularTiempos(newDate);
            $("#modal_ant").text(antiguedad);
        }
    });

    $("#editGenero").on("change", function () {
        let genero = $("#Person_sex").text().trim();
        let Ch_genero = parseInt($("#editGenero").val().trim());
        if (genero == "Masculino") {
            genero = 1;
        } else {
            genero = 2;
        }

        if (Ch_genero != genero) {
            $("#Alerta_genero").fadeIn().removeClass("d-none");
        } else {
            $("#Alerta_genero").fadeOut().addClass("d-none");
        }
    });

    $("#editCodigo").on("change", function () {
        activeLoading();
        var newCode = $("#editCodigo").val().trim();

        if (code == newCode) {
            disableLoading();
            $("#Alerta_err").fadeOut().addClass("d-none");
            ocultarerr("#editCodigo");
        } else {
            var validar = validarCampo(newCode, regexCode, "#editCodigo");

            if (validar) {
                searchCode(newCode)
                    .then((resultado) => {
                        if (resultado) {
                            $("#Alerta_err").fadeOut().addClass("d-none");
                            ocultarerr("#editCodigo");
                        } else {
                            mostrarerr("#editCodigo");
                            $("#Alerta_err").fadeIn().removeClass("d-none");
                        }
                    })
                    .catch((error) => {
                        Swal.fire({
                            title: "¡Error!",
                            text: "Ocurrió un error durante la búsqueda del código ingresado",
                            icon: "error",
                        });
                    });
            }
        }
    });
}

/* Funcion que valida los datos al dar clic al boton de guardar */
function ClicValidarDatos(id) {
    $("#confirm-edit").off("click");
    $("#confirm-edit").on("click", function () {
        // Obtenemos los datos
        var nombre = $("#editNombre").val().trim();
        var correo = $("#editCorreo").val().trim();
        var codigo = $("#editCodigo").val().trim();
        var fechaNacimiento = $("#editFechaNacimiento").val();
        var genero = $("#editGenero").val().trim();
        var estado = $("#editEstado").val().trim();
        var telefono = $("#editTelEmer").val().trim();
        var name_e = $("#editNombreEmer").val().trim();
        var parent_e = $("#editParentEmer").val().trim();

        var gradoEstudio = $("#editGradoEstudio").val().trim();
        var fechaIngreso = $("#editFechaIngreso").val().trim();
        /* Validamos los campos con su respectiva expresión regular y mandamos en id del campo por si hay error */
        let V_codigo = validarCampo(codigo, regexCode, "#editCodigo");
        let V_name = validarCampo(nombre, regexLetters, "#editNombre");
        let V_sex = validarCampo(genero, regexNumero, "#editGenero");
        let V_grade = validarCampo(
            gradoEstudio,
            regexNumero,
            "#editGradoEstudio"
        );

        let V_nacimiento = true;
        V_nacimiento = validarCampo(
            fechaNacimiento,
            regexFecha,
            "#editFechaNacimiento"
        );

        if (fechaNacimiento > fechaActual) {
            // Forzamos el false
            V_nacimiento = validarCampo("", regexFecha, "#editFechaNacimiento");
        } else {
            V_nacimiento = true;
        }

        let V_ingreso = true;
        V_ingreso = validarCampo(fechaIngreso, regexFecha, "#editFechaIngreso");
        if (fechaIngreso > fechaActual) {
            // Forzamos el false
            V_ingreso = validarCampo("", regexFecha, "#editFechaIngreso");
        } else {
            V_ingreso = true;
        }

        let V_estado = validarCampo(estado, regexNumero, "#editEstado");
        // Campos que pueden ser vacios
        let V_correo = true;
        if (correo === "" || correo === "--") {
            correo = null;
            V_correo = true;
        } else {
            V_correo = validarCampo(correo, regexCorreo, "#editCorreo");
        }

        let V_tel = true;
        if (telefono === "" || telefono === "--") {
            telefono = "";
            V_tel = true;
        } else {
            V_tel = validarCampo(telefono, regexTelefono, "#editTelEmer");
        }

        let V_nameE = true;

        if (name_e === "" || name_e === "--") {
            V_nameE = true;
        } else {
            V_nameE = validarCampo(name_e, regexLetters, "#editNombreEmer");
        }
        let V_parent_e = true;

        if (parent_e === "" || parent_e === "--") {
            V_parent_e = true;
        } else {
            V_parent_e = validarCampo(
                parent_e,
                regexLetters,
                "#editNombreEmer"
            );
        }

        if (
            V_codigo &&
            V_name &&
            V_sex &&
            V_grade &&
            V_nacimiento &&
            V_ingreso &&
            V_correo &&
            V_tel &&
            V_nameE &&
            V_estado &&
            V_parent_e
        ) {
            const data = {
                id: id,
                nombre: nombre,
                correo: correo,
                Codigo: codigo,
                genero: genero,
                f_nacimiento: fechaNacimiento,
                f_ingreso: fechaIngreso,
                estudios: gradoEstudio,
                estado_id: estado,
                tel_emergencia: telefono,
                name_emergencia: name_e,
                parentesco_emergencia: parent_e,
            };
            confirmarEdicion(data, id);
        } else {
            Swal.fire({
                title: "¡Error!",
                text: "Parece que hay errores en los datos ingresados",
                icon: "error",
            });
        }
    });
}

/*

/*
    Funcion para confirmar la edicion de un registro
*/
async function confirmarEdicion(PersonalData, id) {
    try {
        const result = await Swal.fire({
            title: "¿Estás seguro de actualizar los datos del registro?",
            text: "Los cambios se verán reflejados en el sistema",
            icon: "warning",
            showCancelButton: true,
            reverseButtons: true,
            cancelButtonColor: "#B04759",
            confirmButtonColor: "#007F73",
            confirmButtonText:
                '<i class="fa-solid fa-pen animated-icon px-1"></i> Actualizar',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        });

        if (result.isConfirmed) {
            await editarPersonal(PersonalData, id);
        }
    } catch (error) {
        // Manejo de errores
         AxiosError(error, "Algo salió mal al actualizar el dato, inténtalo nuevamente.");
    }
}
