import axios from "axios";
import { activeLoading, disableLoading } from "../../loading-screen";

export const requestUpdateHonorarium = (dataSend, id) => {

    return new Promise(async (resolve, reject) => {

        try {
            activeLoading();
            const { data } = await axios.put(`/honorarios/${id}/actualizar`, dataSend);
            disableLoading();

            resolve(data);

        } catch (e) {
            disableLoading();
            console.log(e);
            reject(e);
        }
    });


}