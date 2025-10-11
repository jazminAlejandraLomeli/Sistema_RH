import axios from "axios";

export const requestUploadPhoto = (dataSend) => {

    return new Promise(async (resolve, reject) => {

        try {
            const { data } = await axios.post(`/fotos/subir-foto`, dataSend);

            resolve(data);

        } catch (e) {
            console.log(e);
            reject(e);
        }
    });


}