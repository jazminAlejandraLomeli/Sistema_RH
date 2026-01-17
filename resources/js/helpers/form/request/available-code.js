import { disableLoading } from "../../../loading-screen.js";
import { request_code } from "../../../new-worker/request/search-code.js";
 import { AxiosError } from "../../Alertas.js";

/* Funcion que valida que el codigo esta disponible una vez que de da clic al boton de siguiente, si elcodigo esi esta 
    disponible se llama a la funcion que busca el nombramiento y las distinciones
*/
export async function SearchCode(code) {
    const Data = {
        Codigo: code,
    };

    try {
        // Verificar si el código está disponible
        const response = await request_code(Data);
         return response;
    } catch (error) {
        disableLoading();
        AxiosError(
            error,
            "Algo salio mal al obtener los datos, intentalo otra vez."
        );
        return false;
    }
}

// export async function VerifyCode(code) {
//     const Data = {
//         Codigo: code,
//     };

//     try {
//         // Verificar si el código está disponible
//         const response = await check_unique_code(Data);
//          return response;
//     } catch (error) {
//         disableLoading();
//         AxiosError(
//             error,
//             "Algo salio mal al obtener los datos, intentalo otra vez."
//         );
//         return false;
//     }
// }

