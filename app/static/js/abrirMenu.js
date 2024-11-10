function toggleMenu() {
    var sidebar = document.getElementById("sidebar");
    if (sidebar.style.width === "0px" || sidebar.style.width === "") {
        sidebar.style.width = "250px"; // Abre el menú
    } else {
        sidebar.style.width = "0"; // Cierra el menú
    }
}