export function expandTextArea(id) {
    $(id).on("input", function () {
        this.style.height = "auto";
        this.style.height = this.scrollHeight + "px";
    });
}


export function initTextArea(id) {
    // Ejecutarlo también al cargar la página
    $(id).each(function () {
        this.style.height = "auto";
        this.style.height = this.scrollHeight + "px";
    });
}


