
$(function inicio() {

$(document).on('click', ".fila", function() {
    //   var seleccion = $(this).find('th:nth-child(1)').html();
    var dato = $(this).find('input:nth-child(1)').val();
    var ver = $(this).find('input:nth-child(1)').is(":checked");
    if (ver == false) {
        $(this).find('input:nth-child(1)').prop("checked", true);
    } else {
        $(this).find('input:nth-child(1)').prop("checked", false);
    }
    console.log(dato);
});

$(document).on('click', '.registrar_Confirmacion', function() {
	const row = $(this).closest('tr');
	const id = row.find('td:nth-child(1)').text().trim();
	const producto = row.find('td:nth-child(2)').text().trim();
	const cantidad = row.find('td:nth-child(3)').text().trim();
	const nota = row.find('input[name="comentarios"]').val().trim();
	const seleccionado = row.find('input[name="Confirmacion_Salida"]').is(':checked');

	const data = {
		id,
		producto,
		cantidad,
		nota,
		seleccionado
	};

	console.log(data);
	// Aquí puedes enviar los datos con AJAX o procesarlos como prefieras
	// $.post('/ruta/destino', data, function(response) {
	//     console.log(response);
	// });
	alert(data);

    $.ajax({
        url: base_url + 'Registrar_mercancia_sucursal',
        type: 'POST',
        data: data,
        success: function(respuesta) {
            alert("CAMPOS REGISTRADOS: " + respuesta);
        },
        error: function() {
            console.error("No se ha podido enviar la información");
        }
	});


});





});