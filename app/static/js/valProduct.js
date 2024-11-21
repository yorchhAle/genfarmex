function validateCProd() {
    const clave = document.forms[0]["clave"].value.trim();
    const descripción = document.forms[0]["desc"].value.trim();
    const existencias = parseFloat(document.forms[0]["exis"].value);
    const precio = parseFloat(document.forms[0]["pre"].value);

    // Validar que la clave no esté vacía
    if (!clave) {
        alert("Por favor, ingrese la clave del producto.");
        return false;
    }

    // Validar que la descripción no esté vacía
    if (!descripción) {
        alert("Por favor, ingrese la descripción.");
        return false;
    }

    // Validar existencias como número no negativo
    if (isNaN(existencias) || existencias < 0) {
        document.getElementById("aviExis").style.display = "block";
        return false;
    } else {
        document.getElementById("aviExis").style.display = "none";
    }

    // Validar precio como número no negativo
    if (isNaN(precio) || precio < 0) {
        document.getElementById("aviPre").style.display = "block";
        return false;
    } else {
        document.getElementById("aviPre").style.display = "none";
    }

    return true;
}
