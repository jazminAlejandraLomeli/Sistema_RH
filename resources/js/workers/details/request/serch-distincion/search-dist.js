import { activeLoading, disableLoading } from "../../../../loading-screen";

export const Request_Search = async (Data) => {
    return new Promise(async (resolve, reject) => {
        activeLoading();
        try {
            const response = await axios.post(
                "/personal/distincion-adicional",
                Data
            );

            const { Adicional, Categorias, status } = response.data;

            console.log(response);

            if (response.status === 200) {
                resolve({ Adicional, Categorias, status }); // Retornamos los datos desestructurados
            }
        } catch (error) {
            // Alerta que muestra el error la lista o el error
            if (error.response.status === 422) {
                Swal.fire({
                    title: "¡Error!",
                    text: error.response.data.message,
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "¡Error!",
                    text: "Ocurrió un error al cargar la lista de distinciones adicionales",
                    icon: "error",
                });
            }
            reject(error);
        } finally {
            disableLoading();
        }
    });
};
