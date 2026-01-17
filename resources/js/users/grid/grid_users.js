import { Grid, html, h } from "gridjs";
import { activeLoading, disableLoading } from "../../loading-screen.js";
import traducciones from "../../helpers/translate-gridjs.js";
import { AxiosError } from "../../helpers/Alertas.js";
export async function initialData(clicDetails, clicReset, clicDelete) {
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
                    id: "id_role",
                    name: "id_role",
                    hidden: true,
                },

                {
                    id: "Username",
                    name: "Usuario",
                    formatter: (_, row) => {
                        return h(
                            "div",
                            {
                                className: "d-flex flex-column ",
                            },
                            h("span",
                                {
                                    className: "fw-bolder",
                                },
                                row.cells[2].data),
                            h("span",
                                {
                                    className: "fw-normal",
                                },
                                row.cells[3].data),
                        );
                    },
                },
                {
                    id: "nombre",
                    name: "Nombre",
                    hidden: true,
                },
                {
                    id: "Rol",
                    name: "Rol",
                },
                {
                    id: "status",
                    name: html('<p class="mb-0 text-center">Estatus</p>'),
                    formatter: (cell) => {
                        const status = cell;

                        let statusHtml = null;
                        if (status === "Activo") {
                            statusHtml = h(
                                "span",
                                {
                                    className: "text-success fw-bolder",
                                },
                                status
                            );
                        } else {
                            statusHtml = h(
                                "span",
                                {
                                    className: "text-danger fw-bolder",
                                },
                                status
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
                    formatter: (_, row) => {
                        const status = row.cells[5].data;

                        return h(
                            "div",
                            {
                                className: "d-flex justify-content-center",
                            },
                            h(
                                // Boton de detalles
                                "div",
                                {
                                    className:
                                        "d-flex justify-content-center gap-2",
                                },
                                // Boton de detalles
                                h(
                                    "button",
                                    {
                                        className: "btn-grid",
                                        ...(status === "Activo"
                                            ? {
                                                  onClick: () =>
                                                      clicDetails(
                                                          row.cells[0].data
                                                      ),
                                              }
                                            : {
                                                  disabled: true,
                                                  style: "cursor: not-allowed; opacity: 0.5;",
                                              }),
                                    },
                                    h(
                                        "svg",
                                        {
                                            xmlns: "http://www.w3.org/2000/svg",
                                            width: "25",
                                            height: "25",
                                            viewBox: "0 0 48 48",
                                        },
                                        [
                                            h("path", {
                                                fill: "none",
                                                stroke: "#1B4D3E",
                                                "stroke-linecap": "round",
                                                "stroke-linejoin": "round",
                                                d: "M24 31.186V16.814l5.456 5.884M24 16.814l-5.456 5.884",
                                            }),
                                            h("path", {
                                                fill: "none",
                                                stroke: "#1B4D3E",
                                                "stroke-linecap": "round",
                                                "stroke-linejoin": "round",
                                                d: "M39.245 26.002q.13-.996.14-2.002a17 17 0 0 0-.14-2.002l4.334-3.393a1 1 0 0 0 .25-1.311l-4.104-7.117a1 1 0 0 0-1.251-.44l-5.115 2.061a15.7 15.7 0 0 0-3.463-2.002l-.771-5.435a1 1 0 0 0-1.001-.86h-8.228a1 1 0 0 0-1.001.86l-.771 5.435a15.4 15.4 0 0 0-3.463 2.002L9.526 9.736a1 1 0 0 0-1.252.44L4.17 17.294a1 1 0 0 0 .25 1.312l4.325 3.393A17 17 0 0 0 8.605 24q.01 1.006.14 2.002L4.42 29.395a1 1 0 0 0-.25 1.311l4.103 7.117a1 1 0 0 0 1.252.44l5.115-2.061a15.7 15.7 0 0 0 3.463 2.002l.77 5.435a1 1 0 0 0 1.002.86h8.208a1 1 0 0 0 1-.86l.772-5.435a15.4 15.4 0 0 0 3.463-2.002l5.115 2.062c.468.19 1.005.001 1.251-.44l4.104-7.118a1 1 0 0 0-.25-1.31z",
                                            }),
                                        ]
                                    )
                                ),
                                // Boton de resetear contraseña
                                h(
                                    "button",
                                    {
                                        className: "btn-grid",
                                        ...(status === "Activo"
                                            ? {
                                                  onClick: () =>
                                                      clicReset(
                                                          row.cells[0].data
                                                      ),
                                              }
                                            : {
                                                  disabled: true,
                                                  style: "cursor: not-allowed; opacity: 0.5;",
                                              }),
                                    },
                                    h(
                                        "svg",
                                        {
                                            xmlns: "http://www.w3.org/2000/svg",
                                            width: "25",
                                            height: "25",
                                            viewBox: "0 0 32 32",
                                        },
                                        [
                                            h("path", {
                                                fill: "#0284c7",
                                                //stroke: "#1B4D3E",
                                                "stroke-linecap": "round",
                                                "stroke-linejoin": "round",
                                                d: "M21 2a8.998 8.998 0 0 0-8.612 11.612L2 24v6h6l10.388-10.388A9 9 0 1 0 21 2m0 16a7 7 0 0 1-2.032-.302l-1.147-.348l-.847.847l-3.181 3.181L12.414 20L11 21.414l1.379 1.379l-1.586 1.586L9.414 23L8 24.414l1.379 1.379L7.172 28H4v-3.172l9.802-9.802l.848-.847l-.348-1.147A7 7 0 1 1 21 18",
                                            }),
                                            h("circle", {
                                                cx: "22",
                                                cy: "10",
                                                r: "2",
                                                fill: "#0284c7",
                                            }),
                                        ]
                                    )
                                ),

                                h(
                                    "button",
                                    {
                                        className: "btn-grid",
                                        // onClick: () =>
                                        //     clicDelete(
                                        //         row.cells[0].data,
                                        //         "Inactivo"
                                        //     ),
                                    },

                                    status == "Activo"
                                        ? h(
                                              "button",
                                              {
                                                  className: "btn-grid",
                                                  onClick: () =>
                                                      clicDelete(
                                                          row.cells[0].data,
                                                          "Inactivo"
                                                      ),
                                              },
                                              h(
                                                  "svg",
                                                  {
                                                      xmlns: "http://www.w3.org/2000/svg",
                                                      width: "25",
                                                      height: "25",
                                                      viewBox: "0 0 24 24",
                                                  },
                                                  [
                                                      h("path", {
                                                          fill: "#e11d48",
                                                          d: "M18 19a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V7H4V4h4.5l1-1h4l1 1H19v3h-1zM6 7v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V7zm12-1V5h-4l-1-1h-3L9 5H5v1zM8 9h1v10H8zm6 0h1v10h-1z",
                                                      }),
                                                  ]
                                              )
                                          )
                                        : h(
                                              "button",
                                              {
                                                  className: "btn-grid",
                                                  onClick: () =>
                                                      clicDelete(
                                                          row.cells[0].data,
                                                          "Activo"
                                                      ),
                                              },
                                              h(
                                                  "svg",
                                                  {
                                                      xmlns: "http://www.w3.org/2000/svg",
                                                      width: "25",
                                                      height: "25",
                                                      viewBox: "0 0 24 24",
                                                  },
                                                  [
                                                      h("path", {
                                                          fill: "#1B4D3E",
                                                          d: "M13 3h-2v10h2zm4.83 2.17l-1.42 1.42A6.94 6.94 0 0 1 19 12a7 7 0 0 1-7 7A6.995 6.995 0 0 1 7.58 6.58L6.17 5.17a9 9 0 0 0-1.03 12.69c3.22 3.78 8.9 4.24 12.69 1.02A9 9 0 0 0 21 12c0-2.63-1.16-5.13-3.17-6.83",
                                                      }),
                                                  ]
                                              )
                                          )
                                )
                            )
                        );
                    },
                },
            ],
            // <div class="d-flex justify-content-center"><a href="/personal/detalles/${row.cells[0].data}" class="btn button-details detalles">Detalles</a> </div>

            pagination: {
                limit: 10,
                server: {
                    url: (prev, page, limit) =>
                        `${prev}&limit=${limit}&offset=${page * limit}`,
                },
            },
            search: {
                enabled: true,
                placeholder: "Buscar...",
                className: "form-control border-danger",
                server: {
                    url: (prev, keyword) => `${prev}&search=${keyword}`,
                },
                debounceTimeout: 1000,
            },
            server: {
                url: "/usuarios/get-users?",
                then: (data) => {
                    return data.results.map((user) => [
                        user.id,
                        user?.roles[0]?.id ?? "No tiene rol",
                        user.user_name,
                        user.name,
                        user?.roles[0]?.name ?? "No tiene rol",
                        user.status,
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
            sort: false,
            resizable: true,
            language: traducciones,
        }).render(document.getElementById("Tabla-usuarios"));
    } catch (error) {
        AxiosError(
            error,
            "Algo salio mal al obtener los datos, intentalo otra vez."
        );
    } finally {
        disableLoading();
    }
}
