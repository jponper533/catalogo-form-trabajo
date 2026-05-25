// public/js/copiarPortaPapeles.js
const copiarBtn = document.getElementById('copiarBtn');
const form = document.getElementById('miFormulario');

if (copiarBtn && form) {
    copiarBtn.addEventListener('click', () => {
        const lines = [];

        for (const element of form.elements) {
            if (!element.name || element.name === '_token') continue;

            let value;
            if (element.type === "checkbox") {
                // Si es checkbox múltiple, usar comas
                if (element.name.endsWith("[]")) {
                    const name = element.name.replace("[]", "");
                    const existing = lines.find(l => l.startsWith(name + "="));
                    if (element.checked) {
                        if (existing) {
                            // agregar valor al final
                            existing.split('=')[1] += "," + element.value;
                            // eliminar línea anterior y volver a agregar
                            lines.splice(lines.indexOf(existing), 1);
                            lines.push(name + "=" + existing.split('=')[1]);
                        } else {
                            lines.push(name + "=" + element.value);
                        }
                    }
                    continue;
                } else {
                    value = element.checked ? "true" : "false";
                }
            } else if (element.type === "radio") {
                if (!element.checked) continue;
                value = element.value;
            } else if (element.tagName.toLowerCase() === "select" && element.multiple) {
                value = Array.from(element.selectedOptions).map(opt => opt.value).join(",");
            } else {
                value = element.value;
            }

            lines.push(`${element.name}=${value}`);
        }

        const plainText = lines.join("\n");
        console.log("Datos a copiar:\n" + plainText);

        // Copiar al portapapeles
        if (navigator.clipboard) {
            navigator.clipboard.writeText(plainText)
                .then(() => alert("Formulario copiado al portapapeles!"))
                .catch(err => alert("Error al copiar: " + err));
        } else {
            // Fallback
            const textarea = document.createElement('textarea');
            textarea.value = plainText;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert("Formulario copiado al portapapeles!");
        }
    });
}