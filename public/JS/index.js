$(function inicio() {

	$(".formulario_registro").submit(function(event) {
		event.preventDefault();

		var datosFormulario = $(this);
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		//alert(csrfName+"  "+csrfHash)
		//alert(datosFormulario.serialize());
		ajaxgeneral(datosFormulario,"MandarAlmacen",csrfName,csrfHash);
	});


	$(".Formulario_Corroboracion").submit(function(event) {
		event.preventDefault();

		var datosFormulario = $(this);
		ajaxgeneral(datosFormulario,"MandarCorroboracion");
	});

	$(".Formulario_Producto").submit(function(event) {
		event.preventDefault();
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var datosFormulario = $(this);
		//alert(datosFormulario.serialize());
		ajaxgeneral(datosFormulario,"MandarProducto",csrfName,csrfHash);
	});

	$(".Formulario_Gasto").submit(function(event) {

		event.preventDefault();
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var datosFormulario = $(this);
		alert(datosFormulario.serialize());
		ajaxgeneral(datosFormulario,"MandarProducto_Gasto",csrfName,csrfHash);
	});


	$(".Formulario_produccion_deseada").submit(function(event) {

		event.preventDefault();
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var datosFormulario = $(this);
		alert(datosFormulario.serialize());
		ajaxgeneral(datosFormulario,"MandarProduccionDeseada",csrfName,csrfHash);
	});


	$(".Formulario_produccion").submit(function(event) {

		event.preventDefault();
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var datosFormulario = $(this);

		alert(datosFormulario.serialize());
		ajaxgeneral(datosFormulario,"MandarProduccion",csrfName,csrfHash);
	});

	$(".Formulario_Distribucion").submit(function(event) {

		event.preventDefault();
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var datosFormulario = $(this);

		alert(datosFormulario.serialize());
		ajaxgeneral(datosFormulario,"AgregarDistribucion",csrfName,csrfHash);
	});

	$(".Formulario_Pedidos").submit(function(event) {

		event.preventDefault();
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var datosFormulario = $(this);

		alert(datosFormulario.serialize());
		ajaxgeneral(datosFormulario,"AgregarPedidos",csrfName,csrfHash);
	});





	$(".Formulario_Mermas").submit(function(event) {

		event.preventDefault();
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var datosFormulario = $(this);

		alert(datosFormulario.serialize());
		ajaxgeneral(datosFormulario,"AgregarMermas",csrfName,csrfHash);
	});
	// agregar al server
	$(".Formulario_Utileria").submit(function(event) {

		event.preventDefault();
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var datosFormulario = $(this);

		alert(datosFormulario.serialize());
		ajaxgeneral(datosFormulario,"AgregarPedidosLimpieza",csrfName,csrfHash);
	});

	$(".Formulario_Valor_Predetermindado").submit(function(event) {
		event.preventDefault();
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var datosFormulario = $(this);

		alert(datosFormulario.serialize());
		ajaxgeneral(datosFormulario,"CambiarValorPredeterminado",csrfName,csrfHash);


	});

	$("#Formulario_Paga").submit(function(event) {
		event.preventDefault();
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var datosFormulario = $(this);

		alert(datosFormulario.serialize());
		ajaxgeneraltabla(datosFormulario,"GenerarReporteProduccion",csrfName,csrfHash);


	});


	 
$("#FormEditarMerma").submit(function(event) {
		event.preventDefault();
		var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var datosFormulario = $(this);

		//alert(datosFormulario.serialize());
		//console.log(datosFormulario.serialize());
		ajaxgeneral(datosFormulario,"ActualizarMermas",csrfName,csrfHash);

	});



	var cantidadDeseada = 2;
	var totalEnCaja = 24;
	var valorDecimal = cantidadDeseada / totalEnCaja;
	console.log(valorDecimal);



});

$(".Llegada").click(function() {
	var cardFooter = $(this).closest('.card').find('#Card-footer');
	cardFooter.toggle();

});





function ajaxgeneral(formulario, controlador,csrfName,csrfHash) {
//alert(formulario.serialize());
	$.ajax({
		url: base_url  + controlador,
		type: $(formulario).attr("method"),
		data: formulario.serialize(),[csrfName]: csrfHash,

		success: function(respuesta) {
			$('.txt_csrfname').val(respuesta.token);
			alert("CAMPOS REGISTRA" + respuesta);

		},
		error: function() {
			console.log("No se ha podido obtener la información");


		}
	});

}

function ajaxgeneraltabla(formulario, controlador, csrfName, csrfHash) {
	$.ajax({
		url: base_url + controlador,
		type: $(formulario).attr("method"),
		data: formulario.serialize() + "&" + csrfName + "=" + csrfHash,
		success: function(respuesta) {
			$('.txt_csrfname').val(respuesta.token);
			
			// Remove previous table if exists
			$(formulario).next('table').remove();
			
			// Generate table with data
			let tabla = '<table class="table table-striped"><thead><tr><th>Día</th><th>Fecha</th><th>Total</th></tr></thead><tbody>';
			let sumaTotal = 0;
			
			if (respuesta && Array.isArray(respuesta)) {
				respuesta.forEach(function(item) {
					tabla += '<tr><td>' + item.dia + '</td><td>' + item.fecha + '</td><td>' + item.total + '</td></tr>';
					sumaTotal += parseFloat(item.total) || 0;
				});
			}
			
			tabla += '<tr><td colspan="2"><strong>Total General</strong></td><td><strong>' + sumaTotal.toFixed(2) + '</strong></td></tr>';
			tabla += '</tbody></table>';
			
			// Insert table after form
			$(formulario).after(tabla);
			//alert("CAMPOS REGISTRA");
		},
		error: function() {
			console.log("No se ha podido obtener la información");
		}
	});
}


$("#cerrarsesion").click(function(){
	location.href = base_url+"logout";
	//window.location.replace(base_url+"index.php/Welcome/primera");
});
