/* 
    Script para editar el nombramiento a una persona 
*/
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "../../loading-screen.js";
import { AlertaSweerAlert, AxiosError } from "../../helpers/Alertas.js";

$(function () {
    ClicBorrarprincipal();
    ClicBorrarSecundario();
    clicChange();
});

/*
    Funcion para eliminar el nombramiento principal 
*/
function ClicBorrarprincipal() {
    $("#BtnP").off("click");
    $("#BtnP").on("click", function () {
        var Id = $("#BtnS").data("id");
        var worker = $("#BtnS").data("worker");

        const Datos = {
            Id_trabajo: Id,
            Id_Persona: worker,
        };

        confirmarEliminacion(
            Datos,
            1,
            "¿Estás seguro de eliminar el nombramiento?",
            "El nombramiento principal será eliminado y el secundario pasará a ser el principal.",
            "Eliminar"
        );
    });
}

/*
    Funcion para eliminar el nombramiento secundario
*/
function ClicBorrarSecundario() {
    $("#BtnS").off("click");
    $("#BtnS").on("click", function () {
        var Id = $("#BtnS").data("id");
        var worker = $("#BtnS").data("worker");

        const Datos = {
            Id_trabajo: Id,
            Id_Persona: worker,
        };

        confirmarEliminacion(
            Datos,
            1,
            "¿Estás seguro de eliminar el nombramiento?",
            "El segundo nombramiento será eliminado.",
            "Eliminar"
        );
    });
}

/*
    Clic para intercambiar los nombramientos
*/
function clicChange() {
    $("#Change").off("click");
    $("#Change").on("click", function () {
        var Id = $("#Change").data("id");
        confirmarEliminacion(
            Id,
            3,
            "¿Estás seguro de intercambiar los datos?",
            "El nobramiento secundario cambiará a ser el principal.",
            "Cambiar"
        );
    });
}

/* //////// EDICION ///////// */

/* 
    Funcion para confirmar la edicion de los datos 
*/
async function confirmarEliminacion(Data, Tipo, Title, Texto, Button) {
    
    console.log(Data);
    
    try {
        const result = await Swal.fire({
            title: Title,
            icon: "warning",
            text: Texto,
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#007F73",
            confirmButtonText: Button,
            cancelButtonText: "Cancelar",
            cancelButtonColor: "#B04759",
        });
         if (result.isConfirmed) {
             if (Tipo === 3) {
                // Caso de intercambiar los nombramientos
                await CambiarNombramientos(Data);
            } else {
                // se va a eliminar un nombramiento
                await EliminarNombramiento(Data);
            }
        }
    } catch (error) {
        // Manejo de errores
        AxiosError(error, "Hubo un problema al eliminar el nombramiento.");
    }
}

/*   ////////////////          PETICIONES           ////////////////// */

/*
    Funcion para mandar los datos de eliminar un nombramiento al controlador 
*/
async function EliminarNombramiento(Data) {
    // const datos = {
    //     Id: Id,
    //     Tipo: Tipo,
    // };

    try {
        const response = await axios.put("/eliminar-nombramiento", Data);
        const { data } = response;
        const { status, msg } = data;
        let timerInterval;
        disableLoading();
        if (status == 200) {
            timerInterval = AlertaSweerAlert(
                2500,
                "¡Éxito!",
                msg,
                "success",
                1
            );
        } else {
            timerInterval = AlertaSweerAlert(2500, "¡Error!", msg, "error", 0);
        }
    } catch (error) {
        disableLoading();
        AxiosError(error, "Algo salió mal, inténtalo nuevamente.");
    }
}
/*
    Funcion que llama al controlador para hacer el intercambio en los nombramientos
*/
async function CambiarNombramientos(Id) {

   const Data = {
       Id_persona: Id,
   };
    try {
        const response = await axios.put("/cambiar-nombramiento", Data);
        const { data } = response;
        const { status, msg } = data;
        disableLoading(); // Corregir llamada a la función disableLoading
        let timerInterval;
        if (status == 200) {
            timerInterval = AlertaSweerAlert(
                2000,
                "¡Éxito!",
                "Nombramientos intercambiados correctamente.",
                "success",
                1
            );
        } else {
            timerInterval = AlertaSweerAlert(
                2000,
                "¡Error!",
                "Algo salio mal.",
                "error",
                0
            );
        }
    } catch (error) {
        console.error(error);
        disableLoading(); // Corregir llamada a la función disableLoading
        AxiosError(error, "Algo salió mal, inténtalo nuevamente.");
    }
}
