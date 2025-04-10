function buscarProducto() {
    var searchTerm = document.getElementById('Busqueda').value;
    if (searchTerm.trim() !== '') {
        window.location.href = 'index.php?controlador=productos&action=buscar&search=' + encodeURIComponent(searchTerm);
    }
    return false;
}