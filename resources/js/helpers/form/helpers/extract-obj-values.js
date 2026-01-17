/*
    Script para extraer los valores de un objeto ya 
        que se manda el objeto con las referencias 
*/

 


export function extractValues(obj) {
    const result = {};

    for (const key in obj) {
        if (!obj[key]) continue;

        let value;

        // Si es un input/select/textarea con .val()
        if (obj[key].val) {
            value = obj[key].val();

            if (typeof value === "string") {
                value = value.trim();

                // Si viene vacío, lo tratamos como null
                if (value === "") {
                    value = null;
                }
                // Si es un <select> y el valor parece numérico, convertir a número
                else if (obj[key].is("select") && /^\d+$/.test(value)) {
                    value = Number(value);
                }
            }
        } else {
            value = obj[key];
        }

        result[key] = value;
    }

    return result;
}





export function clearForm(obj) {
    for (const key in obj) {
        if (obj[key] && obj[key].val) {
            obj[key].val(""); // limpia el valor
        }
    }
}
