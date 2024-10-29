document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            const usuario = document.getElementById('usuario').value.trim();
            const contrasena = document.getElementById('contrasena').value.trim();

            if (usuario === '' || contrasena === '') {
                alert('Por favor, complete ambos campos.');
                event.preventDefault(); // Evita el envío del formulario
            }
        });
    }
});
