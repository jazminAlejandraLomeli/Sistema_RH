// import Swal from "sweetalert2/dist/sweetalert2.js";
// import "sweetalert2/src/sweetalert2.scss";
import { disableLoading } from "../loading-screen"
import { gridDirectory } from "./gridDirectory";



window.onload = () => {


    const grid = gridDirectory();


    disableLoading();
}