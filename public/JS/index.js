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
