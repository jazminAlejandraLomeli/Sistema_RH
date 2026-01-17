import { Grid } from "gridjs";
import "gridjs/dist/theme/mermaid.css";

import { disableLoading } from "../loading-screen.js";
import { initInfiniteLogs } from "./grid/infinite-scroll.js";

$(function () {
    // Inicializar tooltips de Bootstrap
    document
        .querySelectorAll('[data-bs-toggle="tooltip"]')
        .forEach((tooltip) => new bootstrap.Tooltip(tooltip));

    // Desactivar pantalla de carga
    disableLoading();
    clicPagination();
    //  initInfiniteLogs();
});

function clicPagination() {
    // $(document).on("click", ".pagination a", function (e) {
    //     e.preventDefault(); // Evitar recarga de página
    //     var url = $(this).attr("href");

    //     // Mostrar loader
    //     $("#pagination-loader").removeClass("d-none");

    //     // Petición AJAX
    //     $.get(url, function (response) {
    //         // Reemplazar solo el contenedor de logs y la paginación
    //         var newLogs = $(response).find("#log-container").html();
    //         var newPagination = $(response).find(".pagination").html();

    //         $("#log-container").html(newLogs);
    //         $(".pagination").html(newPagination);

    //         // Ocultar loader
    //         $("#pagination-loader").addClass("d-none");
    //     }).fail(function () {
    //         alert("Error al cargar los datos.");
    //         $("#pagination-loader").addClass("d-none");
    //     });
    // });
}
