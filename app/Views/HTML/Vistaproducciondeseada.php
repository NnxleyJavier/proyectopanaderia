
<body>

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
	<div class="row">



		<form role="form" class="Formulario_produccion_deseada" id="Formulario_produccion_deseada" name="Formulario_produccion_deseada" method="POST">
			<h1>Añade los cambios de Producción</h1>


			<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

			<div class="form-group">
				<label for="Nombre_Producto">Nombre_Producto</label>
				<select  class="form-control" name="Nombre_Producto" id="Nombre_Producto" required="">
					<option value="sin_dato" selected>Nombre de Producto</option>
					<?php
					foreach ( $Productos as $row )
					{?>
						<option value="<?php echo $row ['idProductos'];?>"><?php echo $row ['Nombre_Producto'];?> </option>
						<?php
					}

					?>
				</select>
			</div>


			<div class="form-group">
				<label for="Cantidad_a_producir">Cantidad a producir </label>
				<input type="number" step="1" class="form-control" placeholder="Cantidad a producir" id="Cantidad_a_producir" name="Cantidad_a_producir">
			</div>


			<br><br>
			<div class="clearfix"></div>
			<button type="submit" class="btn btn btn-primary btn-lg btn-responsive" id="registrar_produccion_deseada"> <span class="glyphicon glyphicon-floppy-saved"></span> registrar produccion deseada</button>
		</form>

	</div>
</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
</body>


