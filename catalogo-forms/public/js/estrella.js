document.querySelector('input[type="checkbox"]').addEventListener('change', function() {
    const icon = document.getElementById('fav-icon');
    if (this.checked) {
        icon.classList.remove('fa-regular');
        icon.classList.add('fa-solid');
    } else {
        icon.classList.remove('fa-solid');
        icon.classList.add('fa-regular');
    }
});