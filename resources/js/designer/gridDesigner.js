import { Grid, html, h, className } from "gridjs";
import "gridjs/dist/theme/mermaid.css";
import traducciones from "../helpers/translate-gridjs";

const formatJobs = (data = []) => {
    return data.map(job => job.area_distincion).join(',');
}

export const gridDesigner = (handleModalEdit) => {

    const grid = new Grid({
        columns: [
            {
                id: 'id',
                hidden: true
            },
            {
                id: 'photo',
                name: html('<p class="text-center">Foto</p>'),
                formatter: (cell) => {

                    let urlImage = '/images/empty-image.jpg';

                    if (cell) {
                        urlImage = `/fotos/obtener-foto/${cell}`;
                    }

                    return h('div', {
                        className: 'd-flex justify-content-center'
                    }, h('img', {
                        src: urlImage,
                        style: {
                            width: '80px',
                            height: '120px',
                            objectFit: 'cover',
                            borderRadius: '8px',
                        },
                        alt: 'Foto',
                    }))
                }

            },
            {
                id: 'code',
                name: 'Código',
            },
            {
                id: 'name',
                name: 'Nombre',
            },
            {
                id: 'area',
                name: 'Área de adscripción',

                formatter: (cell) => {

                    let dependencies = cell.split(',');

                    let template = dependencies.map((dependency, index) => {
                        let style = ''
                        if (index === 0) {
                            style = 'fw-bold text-muted'
                        } else {
                            style = 'fw-light'
                        }

                        return h('p', {
                            className: style
                        }, dependency)
                    })

                    return h('div', {
                        style: {
                            maxWidth: '200px'
                        }
                    }, template)
                }
            },
            {
                id: 'actions',
                name: html('<p class="text-center">Acciones</p>'),
                formatter: (cell, row) => {
                    return h('div', {
                        className: "d-flex justify-content-center gap-2",
                    },
                        [

                            h('button',
                                {
                                    // 'data-bs-toggle': "modal",
                                    // 'data-bs-target': "#modalEdit",
                                    className: 'btn button-details detalles',
                                    onClick: () => { handleModalEdit(row.cells[1].data, row.cells[2].data, row.cells[3].data) }
                                },
                                'Editar foto'
                            )
                        ]
                    )
                }
            }
        ],
        pagination: {
            limit: 10,
            server: {
                url: (prev, page, limit) => {
                    const url = new URL(prev, window.location.origin);
                    url.searchParams.set("limit", String(limit));
                    url.searchParams.set("offset", String(page * limit));
                    console.log(url.toString())

                    return url.toString();                    
                }
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
                    console.log(url.toString())
                    return url.toString();                    
                }
            },
            debounceTimeout: 1000,
        },
        server: {
            url: "/api/designer/get-workers?",
            then: (data) => {
                return data.people.map((person) => [
                    person.id,
                    person.foto_url,
                    person.codigo,
                    person.nombre,
                    formatJobs(person.trabajos),
                    null
                ]);
            },
            total: (data) => {
                return data.count;
            },
        },
        className: {
            th: "thead-color text-black",
            search: "d-flex justify-content-center justify-content-lg-end w-100 py-2",
        },
        autoWidth: true,
        sort: false,
        resizable: true,
        language: traducciones,
    }).render(document.querySelector('#personalTable'));

    return grid
}