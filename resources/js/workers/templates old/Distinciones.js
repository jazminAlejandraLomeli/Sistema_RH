/*
    Plantilla para mostrar las distinciones que tiene dicho nombramiento
*/
export function pantillaDistinciones(id_Select, data) {
    $(id_Select).empty();
    var optionDefault = $("<option>")
        .val("")
        .text("Selecciona una opción")
        .prop("disabled", true)
        .prop("selected", true);
    $(id_Select).append(optionDefault);
    data.forEach(function (distincion) {
        var option = $("<option>")
            .val(distincion.distincion_adicional.id)
            .text(distincion.distincion_adicional.nombre);
        $(id_Select).append(option);
    });
    var ninguna = $("<option>")
        .val("")
        .text("Ninguna")
        .prop("disabled", false)
        .prop("selected", false);
    $(id_Select).append(ninguna);
}
