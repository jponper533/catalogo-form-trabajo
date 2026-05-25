document.getElementById("formularioAjax").addEventListener("submit", function(e) {

    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    fetch(form.action, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            "Accept": "application/json"
        },
        body: formData
    })
    .then(async response => {

        if (!response.ok) {
            let data = await response.json();

            if (data.errors) {
                mostrarErrores(data.errors);
            }

            throw new Error("Error de validación");
        }

        return response.json();
    })
    .then(data => {

        if (data.success) {
            window.location.href = data.redirect;
        }

    })
    .catch(error => {
        console.error(error);
    });

});