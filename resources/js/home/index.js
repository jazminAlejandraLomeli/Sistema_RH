/*  
    Script para el home, donde se hacen las animaciones para los contadores y se hacen las cosnultas segun el card al que le de clic
        Para ver detalles
*/

import { disableLoading } from "../loading-screen.js";

$(document).ready(function () {

    disableLoading();
});

document.addEventListener("DOMContentLoaded", function () {
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );

    tooltipTriggerList.forEach(function (el) {
        // Arreglar title vacío antes de inicializar
        let title =
            el.getAttribute("title") ?? el.getAttribute("data-bs-title");

        if (!title || title.trim() === "") {
            el.setAttribute("title", " ");
        }

        // Evitar que Bootstrap arroje error en consola
        try {
            new bootstrap.Tooltip(el);
        } catch (e) {
            // No mostrar error
          //  console.error('Error initializing tooltip:', e);
        }
    });
});

