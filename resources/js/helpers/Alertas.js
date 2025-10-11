import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

/* Alerta que desaparece después de un intervalo de tiempo */
export function AlertaSweerAlert(Time, Title, msg, icono, type) {
    let timerInterval;
    Swal.fire({
        title: Title,
        html: `
        <div id="msgContainer">
            ${msg}
        </div>
    `,

        icon: icono,
        timer: Time,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
        },
        willClose: () => {
            clearInterval(timerInterval);
        },
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            if (type == 1) {
                window.location.reload();
            }
        }
    });

    return timerInterval;
}

export function AxiosError(
    error,
    defaultMessage = "Algo salió mal al actualizar los datos, inténtalo nuevamente."
) {
    if (error.response) {
        const { status, data } = error.response;

        let errorMessage = defaultMessage;

        // Si `data.errors` es un objeto (errores de validación de Laravel)
        if (data.errors && typeof data.errors === "object") {
            const errorsList = Object.values(data.errors)
                .flat()
                .map((error) => `<li>${error}</li>`) // Convierte cada error en un <li>
                .join(""); // Une todos los <li> en una cadena

            errorMessage = `<ul style="text-align: left;">${errorsList}</ul>`; // Envuelve en <ul>
        } else if (data.message) {
            errorMessage = `<p>${data.message}</p>`; // Mensaje genérico
        }

        Swal.fire({
            title: "¡Error!",
            text: "Paraece que hay datos erróneos",
            html: errorMessage, // Usa `html` en lugar de `text` para renderizar la lista
            icon: "error",
            confirmButtonText: "Aceptar",
        });
    } else {
        Swal.fire({
            title: "Error",
            text: defaultMessage,
            icon: "error",
            confirmButtonText: "Aceptar",
        });
    }
}


