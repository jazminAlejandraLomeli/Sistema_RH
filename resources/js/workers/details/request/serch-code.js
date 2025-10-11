 /*   Funcion que busca el codigo en caso de ser editado y verifica que no se repita con algun otro codigo
*/
export async function searchCode(code) {
    const dataCheck = {
        Codigo: code,
    };

    try {
        const response = await axios.post("/searchCode", dataCheck);
        const { data } = response;
        const { status } = data;
        disableLoading();
        if (status == true) {
            //esta disponible
            return true;
        } else {
            // ya hay algien con el codigo
            return false;
        }
    } catch (error) {
        disableLoading();
        return false; // Manejar el error y retornar false
    }
}