import { AxiosError } from "../../Alertas";
import { activeLoading, disableLoading } from "../../../loading-screen";

export const getCategoriesByNombramiento = async (Data) => {
    return new Promise(async (resolve, reject) => {

        try {
            activeLoading();

            const response = await axios.post("/personal/get-categories", Data);
            const { status, Categorias, Adicional } = response.data;

            resolve({ Adicional, Categorias, status }); // Retornamos los datos desestructurados
        } catch (error) {
 
            if (error.response.status === 422) {  // Lista de errores
                AxiosError(error);
            } else {
                AxiosError(error.response.data.msg);
            }

            reject(error);
        } finally {
            disableLoading();
        }
    });
};
