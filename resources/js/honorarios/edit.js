
/*      
    Script para mostrar validar y crear un honorario
*/
import Swal, { swal } from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "../loading-screen";
import { validateFormHonorario } from "../validators/validateFormHonorario";
import { AxiosError } from "../helpers/Alertas";
import { requestUpdateHonorarium } from "./request/requestUpdateHorarium";

window.onload = () => {

    

    disableLoading();
}