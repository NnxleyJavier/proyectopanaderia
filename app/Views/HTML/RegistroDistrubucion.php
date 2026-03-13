<!-- <link rel="stylesheet" href="../css/Adaptable.css"> -->
<body>

<div class="form-container">
<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 40vh;">
	<div class="row">



		<form role="form" class="Formulario_Distribucion" id="Formulario_Distribucion" name="Formulario_Distribucion" method="POST">
			<h1>Disribucion a sucursales </h1>


			<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

			<div class="form-group">
				<label for="Nombre_Producto">Nombre de Producto</label>
				<select  class="form-control" name="Nombre_Producto" id="Nombre_Producto" required="">
					<option value="sin_dato" selected>Nombre de Producto</option>
                    
    <?php foreach ($CategoriasConStockReal as $item): ?>

        <option value="<?= $item['Categoria'] ?>"
            <?= $item['StockReal'] <= 0 ? 'disabled' : '' ?>>

            <?= $item['Categoria'] ?>
            (Disponible: <?= $item['StockReal'] ?>)

        </option>

    <?php endforeach; ?>

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
            <div class="d-flex justify-content-center">
			<button type="submit" class="btn btn btn-primary btn-lg btn-responsive" id="MandarDistribucion"> <span class="glyphicon glyphicon-floppy-saved"></span> Mandar a Sucursal </button>
            </div>
		</form>

	</div>
</div>




</div>




<div class="container-fluid py-4 d-flex justify-content-center">
    <div class="col-lg-11">

        <div class="card shadow-sm border-0" style="border-radius:15px;">

            <!-- Header -->
            <div class="card-header bg-white border-bottom">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="fas fa-truck text-primary me-2"></i>
                    DISTRIBUCIÓN GENERAL
                </h5>
            </div>

            <!-- Body -->
            <div class="card-body bg-white p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0">

                        <thead style="background-color:#f8f9fa;">
                            <tr class="text-uppercase text-muted small">
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Sucursal</th>
                                <th>Categoría</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($ConsultaDistribucion as $fila): ?>
                                <tr>

                                    <td class="fw-semibold text-dark">
                                        <?= ucfirst($fila['Nombre_Producto']); ?>
                                    </td>

                                    <td class="fw-bold text-primary">
                                        <?= number_format($fila['Cantidad_Salida'], 0, '.', ','); ?>
                                    </td>

                                    <td class="text-dark">
                                        <?= ucfirst($fila['NombreSucursal']); ?>
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <?= $fila['Categoria']; ?>
                                        </span>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>

        </div>

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



<div class="container-fluid mt-4">
    <div class="row">
        
        <div class="col-12 col-lg-6 mb-4">
            <div class="card bg-dark border-secondary shadow">
                <div class="card-header border-secondary">
                    <h5 class="text-white mb-0">
                        <i class="fas fa-industry text-warning mr-2"></i> Producción del Día
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover mb-0 text-center">
                            <thead class="text-secondary text-uppercase" style="background-color: #0d0d0d;">
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($ProduccionHoy)): ?>
                                    <?php foreach ($ProduccionHoy as $nombreProducto => $cantidad): ?>
                                        <tr>
                                            <td class="text-left pl-4 font-weight-bold">
                                                <?= $nombreProducto ?>
                                            </td> 
                                            <td>
                                                <span class="badge badge-success px-3" style="font-size: 0.9rem;">
                                                    <?= $cantidad ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-muted py-4">No hay producción registrada.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 mb-4">
            <div class="card bg-dark border-secondary shadow">
                <div class="card-header border-secondary">
                    <h5 class="text-white mb-0">
                        <i class="fas fa-trash-alt text-danger mr-2"></i> Mermas por Categoría
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover mb-0 text-center">
                            <thead class="text-secondary text-uppercase" style="background-color: #0d0d0d;">
                                <tr>
                                    <th>Categoría</th>
                                    <th>Total Merma</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($MermasHoy)): ?>
                                    <?php foreach ($MermasHoy as $categoria => $cantidadMerma): ?>
                                        <tr>
                                            <td class="text-left pl-4 font-weight-bold">
                                                <?= $categoria ?>
                                            </td>
                                            <td>
                                                <?php if($cantidadMerma > 0): ?>
                                                    <span class="badge badge-danger px-3 shadow-sm" style="font-size: 0.9rem;">
                                                        <?= $cantidadMerma ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary px-3 text-dark">
                                                        0
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-muted py-4">No hay mermas registradas.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../JS/index.js"></script>
</body>