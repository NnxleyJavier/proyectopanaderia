
<body>

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 40vh;">
	<div class="row">



		<form role="form" class="Formulario_Distribucion" id="Formulario_Distribucion" name="Formulario_Distribucion" method="POST">
			<h1>Disribucion a sucursales </h1>


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
				<label for="Nombre_Producto">Nombre Sucursal</label>
				<select  class="form-control" name="Nombre_Sucursal" id="Nombre_Sucursal" required="">
					<option value="sin_dato" selected>Nombres de Sucursales</option>
					<?php
					foreach ( $Sucursales as $row )
					{?>
						<option value="<?php echo $row ['idSucursales'];?>"><?php echo $row ['NombreSucursal'];?> </option>
						<?php
					}

					?>
				</select>
			</div>


			<div class="form-group">
				<label for="Cantidad_Mandar">Cantidad a Mandar a Sucursal </label>
				<input type="number" step="1" class="form-control" placeholder="Cantidad a Mandar a Sucursal" id="Cantidad_Mandar" name="Cantidad_Mandar">
			</div>


			<br><br>
			<div class="clearfix"></div>
			<button type="submit" class="btn btn btn-primary btn-lg btn-responsive" id="MandarDistribucion"> <span class="glyphicon glyphicon-floppy-saved"></span> Mandar a Distribucion</button>
		</form>

	</div>
</div>



<div class="container-fluid d-flex justify-content-center align-items-center" style=" padding: 5px; min-height: 10vh;">
    <div class="row">
        <!-- Tabla de totales por producto -->
        <div class="col-md-12" style="background-color: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
            <h2 style="text-align: center; color: #333;">Registros de Distribucion</h2>
            
            <table class="table table-bordered" style="border-collapse: collapse; width: 100%; background-color: #ffffff;">
                <thead class="table-light">
                    <tr >
                        <th style="padding: 15px; text-align: center; color: #555;">Nombre del Producto</th>
                        <th style="padding: 15px; text-align: center; color: #555;">Cantidad Total Repartida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    // Recorremos cada producto y mostramos la fila correspondiente
                    foreach ($Distribucion as $producto => $Cantidad_Salida) { ?>
                        <tr style="border-bottom: 1px solid #e0e0e0;">
                            <td style="padding: 15px; text-align: center; color: #333;"><?php echo ucfirst($producto); // Convierte la primera letra en mayúscula ?></td>
                            <td style="padding: 15px; text-align: center; color: #333;"><?php echo number_format($Cantidad_Salida, 0, '.', ','); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
</body>