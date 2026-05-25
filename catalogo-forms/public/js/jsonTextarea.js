document.addEventListener("DOMContentLoaded", function () {
    const textarea = document.getElementById("jsonDatos");

    if (!textarea) return;

    try {
        const json = JSON.parse(textarea.value);

        textarea.value = JSON.stringify(json, null, 4);
    } catch (e) {
        console.warn("El contenido no es un JSON válido.");
    }
});