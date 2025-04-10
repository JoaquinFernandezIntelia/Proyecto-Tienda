function buscarProducto() {
    var searchTerm = document.getElementById("Busqueda").value;

    // Realizar la solicitud AJAX
    $.ajax({
        type: 'GET',
        url: 'controller/productos_controller.php', // Asegúrate de que esta URL sea correcta
        data: {
            search: searchTerm
        },
        success: function(response) {
            // Mostrar los resultados en una sección específica
            $('#resultados').html(response);
        },
        error: function(error) {
            console.log(error); // Manejo de errores
        }
    });
}