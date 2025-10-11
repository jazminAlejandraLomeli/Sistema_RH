import axios from "axios";

export const requestStoreHonorarium = (dataSend) => {

    return new Promise(async (resolve, reject) => {
        try {

            const {data} = await axios.post('/honorarios/guardar', dataSend);        
            resolve(data);

        } catch (e) {
            console.log(e);
            reject(e);
        }
    });


}