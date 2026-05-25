document.addEventListener('DOMContentLoaded', () => {

    // Click en la tarjeta redirige
    document.querySelectorAll('.tarjeta-link').forEach(tarjeta => {
        tarjeta.addEventListener('click', () => {
            const url = tarjeta.dataset.url;
            if (url) window.location.href = url;
        });
    });

    // Checkbox favoritos
    document.querySelectorAll(".formcheckbox").forEach(form => {

        const checkbox = form.querySelector("input[type='checkbox']");
        const icon = form.querySelector(".fav-icon");

        // Evitar que cualquier click dentro del label del favorito active la tarjeta
        form.querySelector(".checkLabel").addEventListener("click", e => {
            e.stopPropagation();
        });

        // Cambio de estado
        checkbox.addEventListener("change", function () {
            const nuevoEstado = this.checked;

            // Cambio inmediato del icono
            icon.classList.toggle("fa-solid", nuevoEstado);
            icon.classList.toggle("fa-regular", !nuevoEstado);

            const formData = new FormData(form);
            if (!nuevoEstado) formData.delete("activo");

            fetch(form.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": form.querySelector('input[name="_token"]').value,
                    "Accept": "application/json"
                },
                body: formData
            })
        });
    });

});