
<head>
    <style>
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .bg-primary {
            background-color: #007bff !important;
        }

        .text-white {
            color: #fff !important;
        }

        @media (max-width: 767.98px) {
            .table-responsive {
                border: 0;
            }

            .table-responsive .table {
                margin-bottom: 0;
            }

            .table-responsive .table th,
            .table-responsive .table td {
                white-space: nowrap;
            }
        }

        .container-fluid {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 50vh;
        }

        .row {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        h1 {
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 50vh;">
	<div class="row">



						
							<h1>Confirmacion de distrubucion</h1>

							
							<?php //var_dump($DataDistribucion)  ?>
							<div class="table-responsive mt-4">
                                <table class="table table-bordered bg-primary text-white">
                    <thead>
                        <tr>
                            <th>ID_Control</th>
                            <th>Nombre del Producto</th>
                            <th>Cantidad</th>
                            <th>Nota</th>
                            <th>Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody>a
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
                                <td colspan="5" class="text-center">No hay distribucion por validar para esta sucursal  </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

							<br><br>
					
					

					</div>
				</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
<script src="JS/ayuda.js"></script>
</body>

