import {
    fechaActual,
    regexArea,
    regexLetrasHorario,
    regexNumero,
    validarCampo,
} from "../../generalFuntions";

export function validateWorkData(inputs) {
    const {
        Nombramiento,
        Categoria,
        Adicional,
        Adscripcion,
        Oficial,
        Horas,
        Turno,
        Contrato,
        Vencimiento,
        Departamentos,
        Semblanza,
    } = inputs;

    // Datos obligatorios

    let V_nom = validarCampo(Nombramiento.val(), regexNumero, Nombramiento);
    let V_cat = validarCampo(Categoria.val(), regexNumero, Categoria);
    let V_ads = validarCampo(Adscripcion.val(), regexArea, Adscripcion);
    let V_of = validarCampo(Oficial.val(), regexLetrasHorario, Oficial);
    let V_turno = validarCampo(Turno.val(), regexNumero, Turno);
    let V_hor = validarCampo(Horas.val(), regexNumero, Horas);
    let V_contrato = validarCampo(Contrato.val(), regexNumero, Contrato);

    // Campos obcionales
    let V_deps = true;
    let V_semblanza = true;
    let V_ven = true;
     let V_addi = true;

    // Validar si el nombramiento es profesor de asignatura validar que solamente exista al menos un departamento seleccionado
    if (V_nom && Nombramiento.val() > 4 && Nombramiento.val() < 6) {
        // PA y TA
        const span = $(".ts-wrapper").next("span");
        let Deps = Departamentos.val();

        if (Deps.length == 0) {
            V_deps = false;
            $(".ts-wrapper").addClass("border-danger");
            span.text(
                "Debe selecciona al menos un departamento en la que imparte clases"
            );
            span.show();
        } else {
            V_deps = true;
            $(".ts-wrapper").removeClass("border-danger");
            span.hide();
        }

        if (Semblanza.val() !== "") {
            // Validar si el campo de la semblanza no esta vacio
            V_semblanza = validarCampo(Semblanza.val(), regexArea, Semblanza);
        }
    }
  
    if (Adicional.val() !== "" && Adicional.val() !== null) {
     
        V_addi = validarCampo(Adicional.val(), regexNumero, Adicional);
    }

 
    if (Contrato.val() < 3) {
        // necesita una fecha
        V_ven = validarCampo(Vencimiento.val(), regexNumero, Vencimiento); // validar que no este vacio
        if (Vencimiento.val() == null || Vencimiento.val() == "") {
            V_ven = false;
            V_ven = validarCampo("", regexNumero, Vencimiento);
        }
        if (Vencimiento.val() < fechaActual) {
            Vencimiento.addClass("border border-info"); // Remarcar fecha como invalida
            V_ven = false;
        }
    }

    if (
        V_nom &&
        V_cat &&
        V_addi &&
        V_ads &&
        V_of &&
        V_turno &&
        V_hor &&
        V_contrato &&
        V_ven &&
        V_deps &&
        V_semblanza
    ) {
        return true;
    } else {
        return false;
    }
}
