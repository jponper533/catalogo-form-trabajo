document.getElementById("jsonFile").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (!file) return;

    // comprobar extensión
    if (!file.name.endsWith(".json")) {
        alert("Solo se permiten archivos JSON");
        event.target.value = "";
        return;
    }

    const reader = new FileReader();

    reader.onload = function(e) {
        try {
            const json = JSON.parse(e.target.result);
            document.getElementById("datos").value = JSON.stringify(json, null, 2);
        } catch (error) {
            alert("El archivo no contiene un JSON válido");
        }
    };

    reader.readAsText(file);
});