import axios from "axios";

export const requestDeletePhoto = (dataSend) => {

    return new Promise(async (resolve, reject) => {

        try {
            const { data } = await axios.delete(`/fotos/eliminar-foto/${dataSend}`);

            resolve(data);

        } catch (e) {
            console.log(e);
            reject(e);
        }
    });


}