/*
    Funcion que valida el tipo de contrato y muestra o esconde el Contrato de fecha de termino  en tiempo real
*/

export function getContract(inputs, id_class) {
    const { Contrato, Vencimiento } = inputs;
     Contrato.on("change", function () {
      //  let Contrato.val() = parseInt();
        if (parseInt(Contrato.val()) < 3) {
            if (id_class.hasClass("d-none")) {
                // Agregarle la propiedad si no la tiene
                id_class.fadeIn(500).removeClass("d-none");
            }
        } else {
            if (!id_class.hasClass("d-none")) {
                // Agregarle la propiedad si no la tiene
                id_class.fadeOut(500).addClass("d-none");
                Vencimiento.val(null); // Limpiar el campo
            }
        }
    });
}
