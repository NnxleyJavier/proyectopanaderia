

<div class="container mt-3">
	<form class="form-inline d-flex justify-content-center">
		<input class="form-control mr-sm-2" type="search" placeholder="Buscar producto" aria-label="Buscar" id="searchInput" onkeyup="searchProduct()">
		<button class="btn btn-outline-warning my-2 my-sm-0" type="button" onclick="searchProduct()">Buscar</button>
	</form>
</div>

<script>
function searchProduct() {
	var input, filter, cards, cardContainer, title, i;
	input = document.getElementById("searchInput");
	filter = input.value.toUpperCase();
	cardContainer = document.getElementsByClassName("row")[0];
	cards = cardContainer.getElementsByClassName("col-md-4");
	for (i = 0; i < cards.length; i++) {
		title = cards[i].getElementsByClassName("card-title")[0];
		if (title.innerText.toUpperCase().indexOf(filter) > -1) {
			cards[i].style.display = "";
		} else {
			cards[i].style.display = "none";
		}
	}
}
</script>

<body>
<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
<div class="row col-md-12">

		<?php
		foreach ($datos as $row){
			?>

			<div class="col-md-4 mb-4">
				<div class="card">
					<img src="<?php try { echo $row['imagen_ref'];} catch (Exception $e) {echo  "Undefined ";} if($row['imagen_ref']==Null){}?>" class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title"><?php try { echo $row['Nombre_Materia'];} catch (Exception $e) {echo  "Undefined ";}?></h5>
						<p class="card-text">Cantidad en almacen:<B> <?php try { echo $row['Cantidad_Existente'];} catch (Exception $e) {echo  "Undefined ";}?></B></p>
						<p class="card-text">Tipo de Medición: <B> <?php try { echo $row['Medida'];} catch (Exception $e) {echo  "Undefined ";}?></B></p>
						<p class="card-text">Las/Los <?php try { echo $row['Medida'];} catch (Exception $e) {echo  "Undefined ";}?> contiene:
							<B> <?php try { echo $row['Cantidad_medida'];} catch (Exception $e) {echo  "Undefined ";}?></B>
							<B> <?php try { echo $row['Tipo_medicion'];} catch (Exception $e) {echo  "Undefined ";}?></B>
						</p>


						<button type="submit" class="Llegada btn btn-danger btn-lg btn-responsive" id="Llegada">Corroborar Producto en el almacén </button>



					</div>
					<div id="Card-footer" style="display: none;" >
						<p><b>Formulario de Corroboración</b></p>

						<form role="form" class="Formulario_Corroboracion" id="Formulario_Corroboracion" name="Formulario_Corroboracion" method="POST">

							<div class="form-group">
								<label for="idAlmacen">idAlmacen</label>
								<input type="text" value="<?php try { echo $row['idAlmacen'];} catch (Exception $e) {echo  "Undefined ";}?>" class="form-control" placeholder="idAlmacen" id="idAlmacen" name="idAlmacen" readonly>
							</div>


							<div class="form-group">
								<label for="Referencias_Almacen_idReferencias_Almacen">Referencias_Almacen_idReferencias_Almacen</label>
								<input type="text" value="<?php try { echo $row['Referencias_Almacen_idReferencias_Almacen'];} catch (Exception $e) {echo  "Undefined ";}?>" class="form-control" placeholder="Referencias_Almacen_idReferencias_Almacen" id="Referencias_Almacen_idReferencias_Almacen" name="Referencias_Almacen_idReferencias_Almacen" readonly>
							</div>



							<div class="form-group">
								<label for="Fecha de edición">Fecha de edición</label>
								<input type="date" class="form-control" placeholder="Fecha de edición" id="Fecha_edicion" name="Fecha_edicion">
							</div>


							<div class="form-group">
								<label for="Cantidad a Cambiar">Cantidad a Cambiar</label>
								<input type="number" class="form-control" placeholder="Cantidad a Cambiar" id="Cantidad_cambio_Existente" name="Cantidad_cambio_Existente">
							</div>

							<div class="form-group">
								<label for="Motivo_del_Cambio">Motivo del Cambio</label>
								<input type="text" class="form-control" placeholder="Motivo del Cambio" id="Motivo_del_Cambio" name="Motivo_del_Cambio">
							</div>


							<div class="form-group">
								<label for="Cantidad a Cambiar"><b>Cantidad existente en el Almacen: <?php try { echo $row['Cantidad_Existente'];} catch (Exception $e) {echo  "Undefined ";}?>  <?php try { echo $row['Medida'];} catch (Exception $e) {echo  "Undefined ";}?>    </b></label>

							</div>



							<br><br>
							<div class="clearfix"></div>
							<button type="submit" class="btn btn btn-danger btn-lg btn-responsive" id="registrar_Incremento_Almacen"> <span class="glyphicon glyphicon-floppy-saved"></span> Actualizar Cantidades de Almacen</button>
						</form>

					</div>
				</div>
			</div>
			<?php
		}
		?>


	</div>

</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
</body>
</html>

