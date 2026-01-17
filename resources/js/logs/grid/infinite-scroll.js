import { disableLoading } from "../../loading-screen.js";

// Estado interno
let page = 1;
let loading = false;
let noMoreData = false;


async function renderIcon(text, type) {
    const response = await $.get("/usuarios/logs/component/log-icon", {
        text,
        type,
    });
    return response; // devuelve HTML ya compilado
}


/**
 * Inicializa el scroll infinito y carga la primera página
 */
export function initInfiniteLogs() {
    disableLoading();
    loadLogs();

    $(window).on("scroll", async function () {
        if (loading || noMoreData) return;

        // Detectar si está cerca del final
        if (
            $(window).scrollTop() + $(window).height() >=
            $(document).height() - 200
        ) {
            page++;
            await loadLogs();
        }
    });
}

/**
 * Carga los logs desde el backend y los renderiza como cards
 */
export async function loadLogs() {
    loading = true;
    $("#loading").show();

    try {
        const res = await $.get(`/usuarios/logs/get-logs?page=${page}`);

        console.log(res);
        if (!res.data || res.data.length === 0) {
            noMoreData = true;
            $("#loading").html(
                "<p class='text-muted'>No hay más registros</p>"
            );
            return;
        }

       res.data.forEach(async (log) => {
           const icon = await renderIcon(log.accion, "update-worker");

           const card = `
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    ${icon}
                    <p class="card-text text-muted mt-2">${log.descripcion}</p>
                    <div class="small text-end d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold">${log.fecha || "Sin fecha"}</span>
                        <span class="text-secondary" data-bs-toggle="tooltip" data-bs-title="${
                            log.user?.user_name || "Sin usuario"
                        }">
                            ${log.user?.user_name || "Sin usuario"}
                        </span>
                    </div>
                </div>
            </div>
        </div>`;

           $("#log-container").append(card);
       });

    } catch (err) {
        console.error("Error al obtener logs:", err);
    } finally {
        loading = false;
        $("#loading").hide();
    }
}

/**
 * Permite resetear el estado del scroll (por si cambias de vista)
 */
export function resetInfiniteScroll() {
    page = 1;
    loading = false;
    noMoreData = false;
    $("#log-container").empty();
}
