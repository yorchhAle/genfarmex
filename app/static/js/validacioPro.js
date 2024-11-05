function validateForm() {
    const nombre = document.forms[0]["nombre"].value;
    const contacto = document.forms[0]["contacto"].value;
    const numeroT = document.forms[0]["numeroT"].value;
    const email = document.forms[0]["email"].value;
    const direccion = document.forms[0]["direccion"].value;

    // Validar que el nombre no esté vacío
    if (nombre.trim() === "") {
        alert("Por favor, ingrese el nombre del proveedor.");
        return false;
    }

    // Validar que el contacto no esté vacío
    if (contacto.trim() === "") {
        alert("Por favor, ingrese el contacto.");
        return false;
    }

    // Validar que el número de teléfono tenga el formato correcto
    const phonePattern = /^[0-9]{10,15}$/;
    if (!phonePattern.test(numeroT)) {
        alert("Ingrese un número de teléfono válido (10 a 15 dígitos).");
        return false;
    }

    // Validar que el email tenga un formato válido
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Ingrese un correo electrónico válido.");
        return false;
    }

    // Validar que la dirección no esté vacía
    if (direccion.trim() === "") {
        alert("Por favor, ingrese la dirección del proveedor.");
        return false;
    }

    return true; // Si todas las validaciones pasan
}
