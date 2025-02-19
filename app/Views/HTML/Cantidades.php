<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de  Cantidades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Adaptable.css">
<body>

<div class="form-container" >
    <div class="container-fluid">
	<div class="row">



		<form role="form" class="Formulario_Gasto" id="Formulario_Gasto" name="Formulario_Gasto" method="POST">
			<h1>Añade las Cantidades que usa cada producto</h1>


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
				<label for="Nombre_Producto_de_Almacen">Nombre_Producto de Almacen</label>
				<select  class="form-control" name="Nombre_Producto_de_Almacen" id="Nombre_Producto_de_Almacen" required="">
					<option value="sin_dato" selected>Nombre_Producto de Almacen</option>
					<?php
					foreach ( $Almacen as $row )
					{?>
						<option value="<?php echo $row ['idAlmacen'];?>"><?php echo $row ['Nombre_Materia'];?> </option>
						<?php
					}

					?>
				</select>
			</div>

			<div class="form-group">
				<label for="Cantidad_Gasto">Cantidad que Gasta </label>
				<input type="number" step="0.001" class="form-control" placeholder="Cantidad de Gasto" id="Cantidad_Gasto" name="Cantidad_Gasto">
			</div>


			<br><br>
			<div class="clearfix"></div>
			<button type="submit" class="btn btn btn-primary btn-lg btn-responsive" id="registrar_Cantidades_Gasto"> <span class="glyphicon glyphicon-floppy-saved"></span> Registar Micro Gasto por mercancias</button>
		</form>

	</div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
</body>


