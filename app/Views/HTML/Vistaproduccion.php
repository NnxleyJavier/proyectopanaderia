
<link rel="stylesheet" href="CSS/Adaptable.css">
<body>
<div class="form-container">
    <div class="container-fluid">

	<div class="row">



		<form role="form" class="Formulario_produccion" id="Formulario_produccion" name="Formulario_produccion" method="POST">
            <h4 class="container-fluid d-flex justify-content-center align-items-center"><?php echo $Fecha ?></h4>
			<h3>Añade tu produccion de hoy</h3>


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
				<label for="Cantidad_a_producir">Cantidad a producir real </label>
				<input type="number" step="1" class="form-control" placeholder="Cantidad a producir" id="Cantidad_a_producir" name="Cantidad_a_producir">
			</div>


			<br>
			<div class="clearfix"></div>
			<div class="d-flex justify-content-center">
			    <button type="submit" class="btn btn btn-primary btn-lg btn-responsive" id="registrar_produccion_deseada"> <span class="glyphicon glyphicon-floppy-saved"></span> Registrar</button>
			</div>
		</form>


	</div>





</div>

    <br>
<div class="container-fluid d-flex justify-content-center align-items-center" style=" padding: 5px; min-height: 10vh;">
    <div class="row">
        <!-- Tabla de totales por producto -->
        <div class="col-md-12" style="background-color: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
            <h4 style="text-align: center; color: #333;">Total de registro de produccion de hoy</h4>

            <table class="table table-bordered" style="border-collapse: collapse; width: 100%; background-color: #ffffff;">
                <thead class="table-light">
                    <tr >
                        <th style="padding: 15px; text-align: center; color: #555;">Nombre del Producto</th>
                        <th style="padding: 15px; text-align: center; color: #555;">Cantidad Total Realizada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Recorremos cada producto y mostramos la fila correspondiente
                    foreach ($Consulta as $producto => $cantidad_total) { ?>
                        <tr style="border-bottom: 1px solid #e0e0e0;">
                            <td style="padding: 15px; text-align: center; color: #333;"><?php echo ucfirst($producto); // Convierte la primera letra en mayúscula ?></td>
                            <td style="padding: 15px; text-align: center; color: #333;"><?php echo number_format($cantidad_total, 0, '.', ','); ?></td>
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