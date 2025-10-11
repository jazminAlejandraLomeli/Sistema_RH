/*      
    Script para mostrar los datos con Grid.js
*/
import { activeLoading, disableLoading } from "../loading-screen.js";
import { initialData } from "./grid/grid-honorarios.js";

$(function () {
     const tooltipTriggerList = document.querySelectorAll(
         '[data-bs-toggle="tooltip"]'
     );
     tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));
    disableLoading();
    initialData();
});
