

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


					<button type="submit" class="Llegada btn btn-primary btn-lg btn-responsive" id="Llegada">llegada de producto</button>
				</div>
				<div id="Card-footer" style="display: none;" >
					<p><b>Formulario de Registro de Compra de Mercancia</b></p>

					<form role="form" class="formulario_registro" id="formulario_registro" name="formulario_registro" method="POST">


						<div class="form-group">
							<label for="idAlmacen">idAlmacen</label>
							<input type="text" value="<?php try { echo $row['idAlmacen'];} catch (Exception $e) {echo  "Undefined ";}?>" class="form-control" placeholder="idAlmacen" id="idAlmacen" name="idAlmacen" readonly>
						</div>

						<div class="form-group">
							<label for="Fecha de Ingreso">Fecha de Ingreso</label>
							<input type="date" class="form-control" placeholder="Fecha de Ingreso" id="Fecha_de_Ingreso" name="Fecha_de_Ingreso">
						</div>


						<div class="form-group">
							<label for="Cantidad">Cantidad a Ingresar</label>
							<input type="number" class="form-control" placeholder="Cantidad a Ingresar" id="Cantidad_Ingresada" name="Cantidad_Ingresada">
						</div>
						<label for="Cantidad">Tipo de Medicion</label>
						<select type="text" class="form-control"  id="Tipo_Medicion" name="Tipo_Medicion">

							<option value="<?php try { echo $row['Medida'];} catch (Exception $e) {echo  "Undefined ";}?>" selected><?php try { echo $row['Medida'];} catch (Exception $e) {echo  "Undefined ";}?> </option>
							<option value="<?php try { echo $row['Tipo_medicion'];} catch (Exception $e) {echo  "Undefined ";}?>"><?php try { echo $row['Tipo_medicion'];} catch (Exception $e) {echo  "Undefined ";}?> </option>
						</select>

						<div class="form-group">
							<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
						</div>
<br><br>
						<div class="clearfix"></div>
						<button type="submit" class="btn btn btn-success btn-lg btn-responsive" id="registrar_Incremento_Almacen"> <span class="glyphicon glyphicon-floppy-saved"></span> Registrar</button>
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
