import { Grid, html, h } from "gridjs";
import "gridjs/dist/theme/mermaid.css";

import { activeLoading, disableLoading } from "../../loading-screen.js";
import traducciones from "../../helpers/translate-gridjs.js";
import { AxiosError } from "../../helpers/Alertas.js";

export async function initialData(baseUrl) {
    try {
        activeLoading();
        new Grid({
            columns: [
                {
                    id: "id",
                    name: "id",
                    hidden: true,
                },
                {
                    id: "id_estado",
                    name: "id_estado",
                    hidden: true,
                },
                {
                    id: "codigo",
                    name: "Código",
                    hidden: true,
                },
                {
                    id: "nombre",
                    name: "Nombre",
                    formatter: (_, row) => {
                        const code = row.cells[2].data;
                        const name = row.cells[3].data;

                        return h(
                            "div",
                            {
                                className: "fw-medium",
                            },

                            h(
                                "p",
                                {
                                    className: "fw-bold",
                                },

                                code,
                                h(
                                    "p",
                                    {
                                        className: " fw-medium",
                                    },

                                    name
                                )
                            )
                        );
                    },
                },
                {
                    id: "nombramiento",
                    name: "Nombramiento",
                },
                {
                    id: "estatus",
                    name: html('<p class="mb-0 text-center">Estatus</p>'),
                    formatter: (_, row) => {
                        const status = row.cells[1].data;
                        const status_name = row.cells[5].data;

                        let statusHtml = null;
                        if (status === 1) {
                            statusHtml = h(
                                "p",
                                {
                                    className: "text-success fw-medium",
                                },

                                status_name
                            );
                        } else if (status === 2) {
                            statusHtml = h(
                                "p",
                                {
                                    className:
                                        "text-primary-emphasis fw-medium",
                                },
                                status_name
                            );
                        } else if (status === 3) {
                            statusHtml = h(
                                "p",
                                {
                                    className: "text-warning fw-medium",
                                },
                                status_name
                            );
                        } else if (status === 4) {
                            statusHtml = h(
                                "p",
                                {
                                    className:
                                        "text-warning-emphasiss fw-medium",
                                },
                                status_name
                            );
                        } else {
                            statusHtml = h(
                                "p",
                                {
                                    className: "text-danger fw-medium",
                                },
                                status_name
                            );
                        }

                        return h(
                            "div",
                            {
                                className:
                                    "d-flex justify-content-center align-items-center",
                            },
                            statusHtml
                        );
                    },
                    sort: false,
                },
                {
                    id: "actions",
                    name: html('<p class="mb-0 text-center">Acciones</p>'),
                    formatter: (_, row) =>
                        html(
                            `<div class="d-flex justify-content-center"><a href="/personal/detalles/${row.cells[0].data}" class="btn button-details detalles">Detalles</a> </div>`
                        ),
                },
            ],
            pagination: {
                limit: 10,
                server: {
                    url: (prev, page, limit) => {
                        const url = new URL(prev, window.location.origin);
                        url.searchParams.set("limit", String(limit));
                        url.searchParams.set("offset", String(page * limit));
                        return url.toString();
                    },
                },
            },
            search: {
                enabled: true,
                placeholder: "Buscar...",
                className: "form-control border-danger",
                server: {
                    url: (prev, keyword) => {
                        const url = new URL(prev, window.location.origin);
                        url.searchParams.set("search", String(keyword));
                        return url.toString();
                    },
                },
                debounceTimeout: 1000,
            },
            server: {
                url: baseUrl,
                then: (data) => {
                 
                    return data.results.map((person) => [
                        person.id,
                        person.id_estado,
                        person.codigo,
                        person.nombre,
                        person.nombramiento,
                        person.estatus,
                    ]);
                },
                total: (data) => {
                    return data.count;
                },
            },
            className: {
                th: "thead-color text-white bg-grid",
                search: "d-flex justify-content-center justify-content-lg-end w-100 py-2",
            },
            autoWidth: true,
            // // sort: {
            // //     //  enabled: true,
            // //     multiColumn: false,
            // //     initialColumn: 0,
            // // },
            // resizable: true,
            language: traducciones,
        }).render(document.getElementById("Tabla-Personal"));
    } catch (error) {
        AxiosError(
            error,
            "Algo salio mal al obtener los datos, intentalo otra vez."
        );
    } finally {
        disableLoading();
    }
}
