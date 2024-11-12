function validateCProd() {
    const clave = document.forms[0]["clave"].value;
    const descripción = document.forms[0]["desc"].value;
    const existencias = document.forms[0]["exis"].value;
    const precio = document.forms[0]["pre"].value;

    // Validar que la clave no esté vacía
    if (clave.trim() === "") {
        alert("Por favor, ingrese la clave del producto.");
        return false;
    }

    // Validar que el producto no esté vacío
    if (descripción.trim() === "") {
        alert("Por favor, ingrese la descripción.");
        return false;
    }

    // Validar que el número de inventario sea mayor a 0
    if (isNaN(existencias) || existencias < 0) {
        alert("Ingrese un valor de existencia válido (número mayor o igual a 0).");
        return false;
    }

    // Validar que el precio sea numérico
    if (isNaN(precio) || precio < 0) {
        alert("Ingrese un precio válido (mayor o igual a 0).");
        return false;
    }

    return true; // Si todas las validaciones pasan
}
