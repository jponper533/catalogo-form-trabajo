document.addEventListener('DOMContentLoaded', () => {
    const favForms = document.querySelectorAll('.formcheckbox');

    document.querySelectorAll('.tarjetas').forEach(tarjeta => {
        tarjeta.addEventListener('click', () => {
            const url = tarjeta.dataset.url;
            if (url) window.location.href = url;
        });
    });

    favForms.forEach(form => {
        const checkbox = form.querySelector('input[type="checkbox"]');
        const label = form.querySelector('.checkLabel');

        label.addEventListener('click', e => e.stopPropagation());

        checkbox.addEventListener('change', (e) => {
            if (!checkbox.checked) {
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        const tarjeta = form.closest('.tarjetas');
                        if (tarjeta) {
                            tarjeta.remove(); 
                        }
                    } else {
                        console.error('No se pudo quitar el favorito');
                        checkbox.checked = true;
                    }
                })
                .catch(err => {
                    console.error('Error de red:', err);
                    checkbox.checked = true;
                });
            }
        });
    });
});