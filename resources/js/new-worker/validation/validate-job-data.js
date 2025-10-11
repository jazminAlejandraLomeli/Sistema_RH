/* Funcion que obtiene losa datos del formulario y los valida */
import {
    validarCampo,
    regexCode,
    regexLetters,
    regexNumero,
    regexFecha,
    regexCorreo,
    ocultarerr,
    mostrarerr,
    fechaActual,
    automaicScroll,
    regexLetrasHorario,
    regexArea,
    regexTelefono,

    
} from "../../helpers/generalFuntions";

export function Validate_Data() {
    var band = 0;
    // Obtener los valores
    var nombramiento = $("#nombramientos").val();
    var id_categoria = $(".categorias").val();
    var area_distincion = $(".dep").val();
    var distincion_adicional = $("#Distincion_Adicional").val();
    var horario_oficial = $("#hor_oficial").val().trim();
    var turno = $("#shift").val();
    var tipo_contrato = $("#contrato").val();
    var fecha_termino = $(".fecha_termino").val();
    var horas_trabajo = $("#hours").val();
    const departament = $("#department").val();
    const semblanza = $("#semblanza").val();

    let validateDepartamento = true;

    let V_horasT = validarCampo(horas_trabajo, regexNumero, "#hours");

    //Validar los datos
    let V_nombramiento = validarCampo(
        nombramiento,
        regexNumero,
        "#nombramientos"
    );
    let V_categoria = validarCampo(id_categoria, regexNumero, "#categorias");
    //let V_distincion = validarCampo(distincion_adicional,regexNumero,"#Distincion_Adicional");
    let V_area = validarCampo(area_distincion, regexArea, "#dep");
    let V_horarioOf = validarCampo(
        horario_oficial,
        regexLetrasHorario,
        "#hor_oficial"
    );

    let V_turno = validarCampo(turno, regexNumero, "#shift");
    let V_tipo = validarCampo(tipo_contrato, regexNumero, "#contrato");

    // Si el contrato es temporal o interinato
    if (tipo_contrato < 3) {
        let V_fechaT = validarCampo(
            fecha_termino,
            regexFecha,
            ".fecha_termino"
        );

        if (!V_fechaT) {
            band = 1;
        } else {
            $(".fecha_termino").removeClass("border border-error");
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


        if (semblanza !== "") {  // Validar si el campo de la semblanza no esta vacio
            V_semblanza = validarCampo(semblanza, regexArea, "#semblanza");
        }

        
    }

    if (
        band === 0 &&
        V_nombramiento &&
        V_categoria &&
        V_area &&
        V_horarioOf &&
        V_tipo &&
        V_turno &&
        V_horasT &&
        validateDepartamento  &&
        V_semblanza
    ) {
        const JobData = {
            Nombramiento: nombramiento,
            Categoria: id_categoria,
            Adicional: distincion_adicional,
            Adscripcion: area_distincion,
            Oficial: horario_oficial,
            Horas: horas_trabajo,
            Turno: turno,
            Contrato: tipo_contrato,
            Vencimiento: fecha_termino,
            Departamentos: departament,
            Semblanza: semblanza,
        };

        return JobData;
    } else {
        return null; // o null, según lo que esperes en el código que recibe este return
    }
}
