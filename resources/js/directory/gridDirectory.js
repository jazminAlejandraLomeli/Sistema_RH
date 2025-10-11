import { Grid, html, h, className } from "gridjs";
import "gridjs/dist/theme/mermaid.css";
import traducciones from "../helpers/translate-gridjs";

export const gridDirectory = () => {

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
                        urlImage = `/directorio/obtener-foto/${cell}`;
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
                id: 'name',
                name: 'Nombre',
            },
            {
                id: 'area',
                name: "Área de adscripción"
            }

        ],
        pagination: {
            limit: 10,
            server: {
                url: (prev, page, limit) => {
                    const url = new URL(prev, window.location.origin);
                    url.searchParams.set("limit", String(limit));
                    url.searchParams.set("offset", String(page * limit));
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
                    return url.toString();
                }
            },
            debounceTimeout: 1000,
        },
        server: {
            url: "/api/directory/get-workers?",
            then: (data) => {                
                return data.people.map((person) => [
                    person.id,
                    person.foto_url,
                    person.nombre,
                    person?.priority?.area_distincion || 'No tiene'
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