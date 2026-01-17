/*
Funcion para mostrar la categorias obtenidas con el arreglo de categorias y el id del select 
*/
export function templateCategories(id_select, Categorias) {
    id_select.hide();
    // Vacía el select para eliminar las opciones predefinidas
   id_select.empty();
    var optionDefault = $("<option>")
        .val("")
        .text("Selecciona una opción")
        .prop("disabled", true)
        .prop("selected", true);
    id_select.append(optionDefault);
    Categorias.forEach(function (Categoria) {
        var option = $("<option>").val(Categoria.id).text(Categoria.nombre);
        id_select.append(option);
    });
    id_select.show();
}
