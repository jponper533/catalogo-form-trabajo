document.getElementById('formBusqueda').addEventListener('submit', function(e) {
    e.preventDefault();

    var nombre = document.getElementById('buscarNombre').value;
    var etiqueta = document.getElementById('buscarEtiqueta').value;

    // 1. URL de tu ruta definida en web.php
    var url = '/buscar';

    // 2. Petición POST con CSRF y JSON
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // Buscamos el token CSRF que Laravel pone en el HTML
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            nombre: nombre,
            etiqueta: etiqueta
        })
    })
    .then(function(res) { return res.json(); })
    .then(function(datos) {
        document.getElementById('contenedor-tabla').innerHTML = construirTabla(datos);
    })
    .catch(function(err) { console.error("Error:", err); });
});
