document.addEventListener('keydown', e => {
    if (e.key === "Escape") {
        document.querySelector('.agregar').classList.remove('active');
        document.querySelector('.eliminar').classList.remove('active');
    }
});