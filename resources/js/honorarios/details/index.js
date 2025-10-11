import Swal, { swal } from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { validateFormHonorario } from "../../validators/validateFormHonorario";
import { AxiosError } from "../../helpers/Alertas";
import { requestUpdateHonorarium } from "../request/requestUpdateHorarium";
import { activeLoading, disableLoading } from "../../loading-screen";
/*      
    Script para mostrar los datos con Grid.js
*/

$(function () {

    const form = document.querySelector('#formEdit');    
    const btnUpdate = document.querySelector('#personal-data');
    const code = document.querySelector('#code');
    const id = document.querySelector('#id');

    // Hacemos funcionar el tooltip
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    tooltipTriggerList.forEach((tooltip) => new bootstrap.Tooltip(tooltip));

    const fields = [];

    // Obtenemos todos los inputs y selects del formulario
    form.querySelectorAll('input, select').forEach(field => fields[field.name] = field);

    const handleSuccessStore = ({ msg }) => {
        Swal.fire({
            title: "Éxito",
            text: msg,
            icon: "success",
            confirmButtonText: "Aceptar",
        }).then(() => {
            location.reload();
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

    const handleForm = () => {
        
        // Convertimos la data en form data
        const data = new FormData(form);
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


        // return;

        Swal.fire({
            title: "¿Estás seguro de actualizar los datos del registro?",
            text: "Los cambios se verán reflejados en el sistema",
            icon: "warning",
            showCancelButton: true,
            reverseButtons: true,
            cancelButtonColor: "#B04759",
            confirmButtonColor: "#007F73",
            confirmButtonText:
                '<i class="fa-solid fa-pen animated-icon px-1"></i> Actualizar',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        }).then(({ isConfirmed }) => {
            if (isConfirmed) {

                const dataSend = {}
                for (const [key, value] of data.entries()) {
                    dataSend[key] = value;
                }


                // return;

                // Hacemos una peticion asincrona con axios
                requestUpdateHonorarium(dataSend, id.value)
                    .then(handleSuccessStore)
                    .catch(handleErrorStore);
            }

        })
    }

    // const handleCancelForm = () => {
    //     Swal.fire({
    //         title: "¿Estás seguro?",
    //         text: "Toda la información ingresada se perderá",
    //         icon: "warning",
    //         confirmButtonText: "Si estoy seguro",
    //         cancelButtonText: "Cancelar",
    //         showCancelButton: true,
    //         reverseButtons: true,
    //         confirmButtonColor: "#d33"
    //     }).then(({ isConfirmed }) => {
    //         if (isConfirmed) {
    //             location = '/honorarios/';
    //         }
    //     });
    // }

    // Evento de escucha cuando hace el submit
    btnUpdate.addEventListener('click', handleForm)
    // btnCancel.addEventListener('click', handleCancelForm)

    disableLoading();
});
