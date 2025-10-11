/*      
    Script para mostrar los datos con Grid.js
*/
import { activeLoading, disableLoading } from "../loading-screen.js";
import { initialData } from "./grid/grid-people.js";
 
$(function () {
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));
    disableLoading();

   
    // 1. Obtener el parámetro de la URL actual
    const urlParams = new URLSearchParams(window.location.search);
    const urlTexto = urlParams.get("param"); // 'tipo' es el nombre de tu parámetro en la URL

    // 2. Construir la URL base
    let baseUrl = "/personal/obt-personal?";

    // 3. Añadir el parámetro solo si existe
    if (urlTexto) {
        baseUrl += `&param=${urlTexto}`;
    }

    gettitle(urlTexto);
    initialData(baseUrl);
});

function gettitle(texto) {
    let title = "";

    if (texto === null) {
        title = "Personal del CUAltos";
    } else if (texto === "Femenino") {
        title = "Personal Femenino del CUAltos";
    } else if (texto === "Masculino") {
        title = "Personal Masculino del CUAltos";
    } else if (texto === "Temporal") {
        title = "Contratos Temporales próximos a vencer";
    } else if (texto === "Interinato") {
        title = "Contratos Interinatos próximos a vencer";
    } else if (texto === "Definitivo") {
        title = "Contratos Definitivos";
    } else if (texto === "Expired-Temporal") {
        title = "Contratos Temporales expirados";
    } else if (texto === "Expired-Interinato") {
        title = "Contratos Interinatos expirados";
    }

    $(".title").text(title);
}
