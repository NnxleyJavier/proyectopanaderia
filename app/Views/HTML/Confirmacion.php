

<body>

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
	<div class="row">



						
							<h1>Confirmacion de distrubucion</h1>

							
							<?php //var_dump($DataDistribucion)  ?>
							<div class="table-responsive mt-4">
                <table class="table table-bordered bg-success text-white">
                    <thead>
                        <tr>
                            <th>ID_Control</th>
                            <th>Nombre del Producto</th>
                            <th>Cantidad</th>
                            <th>Nota</th>
                            <th>Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($DataDistribucion)) { 
                            foreach ($DataDistribucion as $item) { ?>
                                <tr class="fila">

									<td><b><?php try {echo htmlspecialchars ($item['idSalida_Mercancia']);} catch (Exception $e) {echo  "Undefined ";} ?></b></td>
                                    <td><b><?php try {echo htmlspecialchars ($item['Nombre_Producto']);} catch (Exception $e) {echo  "Undefined ";} ?></b></td>
									<td><b><?php try {echo htmlspecialchars ($item['Cantidad_Salida']);} catch (Exception $e) {echo  "Undefined ";} ?></b></td>

                                    <td> <input type="text" name="comentarios" class="form-control" placeholder="Agregar comentarios"></td>
                                    <td>
                                        <input type="checkbox" name="Confirmacion_Salida" value="1">
                                    </td>
									<td><button type="submit" class="btn btn btn-primary btn-lg btn-responsive registrar_Confirmacion" name="registrar_Confirmacion"> <span class="glyphicon glyphicon-floppy-saved"></span> Confirmar</button></td>
                                </tr>
                        <?php } 
                        } else { ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay distribucion por validar </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

							<br><br>
							<div class="clearfix"></div>
							<button type="submit" class="btn btn btn-primary btn-lg btn-responsive" id="registrar_Confirmacion"> <span class="glyphicon glyphicon-floppy-saved"></span> Confirmar Cantidad</button>
					

					</div>
				</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
<script src="JS/ayuda.js"></script>
</body>

