
/*      
    Script para mostrar validar y crear un honorario
*/
import Swal, { swal } from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "../loading-screen";
import { validateFormHonorario } from "../validators/validateFormHonorario";
import { requestStoreHonorarium } from "./request/requestStoreHonorarium";
import { AxiosError } from "../helpers/Alertas";

window.onload = () => {

    const form = document.querySelector('#formCreate');
    const btnCancel = document.querySelector('.button-cancel');
    const code = document.querySelector('#code');

    // Hacemos funcionar el tooltip
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));

    const fields = [];

    // Obtenemos todos los inputs y selects del formulario
    form.querySelectorAll('input, select').forEach(field => fields[field.name] = field);
    console.log(fields);

    const handleSuccessStore = ({ msg }) => {
        Swal.fire({
            title: "Éxito",
            text: msg,
            icon: "success",
            confirmButtonText: "Aceptar",
        }).then(() => {
            location = '/honorarios/'
        });
    }

    // Manejo de errores en la peticion para guaraar el honorario
    const handleErrorStore = (e) => {
        if (e.response.status === 422) {
            AxiosError(e);
            return;
        }

        let msg = e.response?.data?.message || 'Hubo un error inesperado al guardar el honorario';
        Swal.fire({
            title: "Oops.. !",
            text: msg,
            icon: "error",
            confirmButtonText: "Ocultar"
        });



    }

    const handleForm = (e) => {
        e.preventDefault();

        // Convertimos la data en form data
        const data = new FormData(e.target);
        data.append('code', code.value);

        // Validamos si hay un dato erroneo
        if (!validateFormHonorario(data, fields)) {
            Swal.fire({
                title: "Oops..!",
                text: "Al parecer tienes errores en el formulario",
                icon: "error",
                confirmButtonText: "Aceptar",
            });

            return;
        }

        const dataSend = {}
        for (const [key, value] of data.entries()) {
            dataSend[key] = value;
        }

        // Hacemos una peticion asincrona con axios
        requestStoreHonorarium(dataSend)
            .then(handleSuccessStore)
            .catch(handleErrorStore);
    }

    const handleCancelForm = () => {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Toda la información ingresada se perderá",
            icon: "warning",
            confirmButtonText: "Si estoy seguro",
            cancelButtonText: "Cancelar",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#d33"
        }).then(({ isConfirmed }) => {
            if (isConfirmed) {
                location = '/honorarios/';
            }
        });
    }

    // Evento de escucha cuando hace el submit
    form.addEventListener('submit', handleForm)
    btnCancel.addEventListener('click', handleCancelForm)

    disableLoading();
}