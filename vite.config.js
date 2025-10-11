import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/sass/sideBar.scss",
                "resources/sass/home.scss",
                "resources/js/SideBar.js",
                "resources/sass/colorButtons.scss",
                "resources/sass/loadingScreen.scss",
                "resources/sass/users.scss",
                "resources/sass/StyleForm.scss",
                "resources/js/home/index.js",
                "resources/js/profile/index.js",
                "resources/js/users/index.js",
                "resources/js/workers/index.js",
                "resources/js/workers/details/PersonalData.js",
                "resources/js/workers/details/Nombramientos.js",
                "resources/js/workers/details/new-Nombramiento.js",
                "resources/js/workers/details/Principal.js",
                "resources/js/workers/details/Secundario.js",
                "resources/js/new-worker/new-worker.js",
                "resources/js/helpers/generalFuntions.js",
                "resources/js/users/add_user.js",
                "resources/js/users/update_user.js",
                "resources/js/honorarios/index.js",
                "resources/js/honorarios/create.js",
                "resources/js/honorarios/details/index.js",
                "resources/js/designer/index.js",
                "resources/js/directory/index.js",
                "resources/js/helpers/login.js"
            ],
            refresh: true,
        }),
    ],
});
