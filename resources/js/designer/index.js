import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "../loading-screen"
import { gridDesigner } from "./gridDesigner";
import { validateUpdatePhoto } from "../validators/validateUploadPhoto";
import { requestUploadPhoto } from './request/requestUploadPhoto';
import { AxiosError } from "../helpers/Alertas";
import { requestDeletePhoto } from "./request/requestDeletePhoto";

const formData = {
    code: '',
    photo: ''
}

const urlDefault = '/images/empty-image.jpg';
window.onload = () => {


    const preview = document.querySelector('#preview');
    const photo = document.querySelector("#photo");
    const contentModal = document.querySelector('#contentModal');
    const modalEdit = new bootstrap.Modal(document.getElementById('modalEdit'));
    const btnUploadPhoto = document.querySelector('#uploadPhoto');
    const btnCloseModals = document.querySelectorAll('.close-modal-edit');
    const btnDeletePhoto = document.querySelector('#deletePhoto');

    const fields = {
        [photo.name]: photo
    };


    const handleModalEdit = (urlImage, code, name) => {
        if (urlImage) {
            preview.src = `/fotos/obtener-foto/${urlImage}`;
            btnDeletePhoto.classList.remove('d-none');
            btnDeletePhoto.disabled = false;
        } else {
            preview.src = urlDefault;
            btnDeletePhoto.classList.add('d-none');
            btnDeletePhoto.disabled = true;
        }

        formData.code = code;
        contentModal.innerHTML = `<h5>${name}</h5><p>${code}</p>`;
        modalEdit.show();

    }

    const handlePhoto = ({ target }) => {
        const file = target.files[0];
        if (file && file.type.startsWith("image/")) {
            const reader = new FileReader();
            formData.photo = file;

            reader.onload = function (e) {
                preview.src = e.target.result; // Muestra la imagen
            };

            reader.readAsDataURL(file); // Lee el archivo como URL base64
        } else {
            preview.src = urlDefault;

            Swal.fire({
                title: 'Oops..!',
                text: 'No ha seleccionado una imágen válida',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })
        }
    };

     // Tabla de registros de trabajadores
    const grid = gridDesigner(handleModalEdit);


    // Se maneja la respuesta que fue exitosa
    const handleSuccess = (response) => {
        disableLoading();
       
        Swal.fire({
            title : 'Éxito',
            text : response.msg,
            icon : 'success',
            confirmButtonText : 'Aceptar' 
        });

        modalEdit.hide();
        grid.forceRender();
    }

    // Se maneja la respuesta que tuvo error
    const handleError = (error) => {
        disableLoading();
       
        if(error.status == 422){
            AxiosError(error, 'Oops ...!, error inesperado')
            return;
        }

        Swal.fire({
            title : 'Oops...!',
            text : error?.response?.msg || 'Ha sucedido un error inesperado al almacenar la foto a la persona. Por favor vuelve a intentar',
            icon : 'error',
            confirmButtonText : 'Aceptar'
        })
    }

    // Se maneja el evento de subir imagen
    const handleUploadPhoto = (e) => {
        e.preventDefault();

        // Se crea un form data
        const data = new FormData();

        // Se agregan los valores del codigo y la imagen seleccionada
        data.append('code', formData.code);
        data.append('photo', formData.photo);


        // Se validan que cumplan las reglas en caso de que no muestra las alertas de error correspondiente
        if (!validateUpdatePhoto(data, fields)) {
            return;
        }



        activeLoading();
        requestUploadPhoto(data)
            .then(handleSuccess)
            .catch(handleError)

    }

    // Mane
   

    // Cuando presiona el botn de modal se reinician los valores
    const handleCloseModal = () => {
        photo.value = '';
        formData.code = '';
        formData.photo = '';
        modalEdit.hide();

    }

    // Manejo de eliminacion de foto
    const handleDeletePhoto = () => {
        Swal.fire({
            title : '¿Estas seguro?',
            text : 'Al eliminar la foto no podrás recuperarla',
            icon : 'warning',
            confirmButtonText: 'Si estoy seguro',
            confirmButtonColor : '#d33',
            cancelButtonText: 'Cancelar',
            showCancelButton  : true,
            reverseButtons : true
        }).then(({isConfirmed})=> {
            if(isConfirmed){
                activeLoading();
                requestDeletePhoto(formData.code)
                    .then(handleSuccess)
                    .catch(handleError)
            }
        })
    }

   

    // Eventos de escucha
    photo.addEventListener("change", handlePhoto);
    btnUploadPhoto.addEventListener('click', handleUploadPhoto)

    btnCloseModals.forEach(btnCloseModal => {
        btnCloseModal.addEventListener('click', handleCloseModal)
    });

    btnDeletePhoto.addEventListener('click', handleDeletePhoto);

    disableLoading();
}