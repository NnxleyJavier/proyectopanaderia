
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

<div class="container-fluid">
    <div class="row">
        <h1>Confirmacion Solicitudes de Utileria</h1>
        <?php //var_dump($DataDistribucion)  ?>
        <div class="table-responsive mt-4">
            <table class="table table-bordered bg-primary text-white">
                <thead>
                    <tr>
                        <th>ID_Control</th>
                        <th style="display:none;">idAlmacen</th>
                        <th>Cantidad_Pedido</th>
                        <th>Producto Solicitado</th>
                        <th>Estatus</th>
                        <th>Fecha_Solicitud</th>
                        <th>Sucursal</th>
                        <th>Nombre de Encargado</th>
                        <th>Seleccionar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($Listado)) { 
                        foreach ($Listado as $item) { ?>
                            <tr class="fila">
                                <td><b><?php try {echo htmlspecialchars ($item['Id_Utilerias_Sucursales']);} catch (Exception $e) {echo  "Undefined ";} ?></b></td>
                                <td style="display:none;"><b><?php try {echo htmlspecialchars ($item['idAlmacen']);} catch (Exception $e) {echo  "Undefined ";} ?></b></td>
                                <td><b><?php try {echo htmlspecialchars ($item['Cantidad_Pedido']);} catch (Exception $e) {echo  "Undefined ";} ?></b></td>
                                <td><b><?php try {echo htmlspecialchars ($item['Nombre_Materia']);} catch (Exception $e) {echo  "Undefined ";} ?></b></td>
                                <td><b><?php try {echo htmlspecialchars ($item['Estatus']);} catch (Exception $e) {echo  "Undefined ";} ?></b></td>
                                <td><b><?php try {echo htmlspecialchars ($item['Fecha_Solicitud']);} catch (Exception $e) {echo  "Undefined ";} ?></b></td>
                                <td><b><?php try {echo htmlspecialchars ($item['NombreSucursal']);} catch (Exception $e) {echo  "Undefined ";} ?></b></td>
                                <td><b><?php try {echo htmlspecialchars ($item['Nombre']);} catch (Exception $e) {echo  "Undefined ";} ?></b></td>
                                <td>
                                    <input type="checkbox" name="Confirmacion_Salida" value="1">
                                </td>
                                <td><button type="submit" class="btn btn btn-primary btn-lg btn-responsive registrar_Envio_Material" name="registrar_Envio_Material"> <span class="glyphicon glyphicon-floppy-saved"></span> Confirmar</button></td>
                            </tr>
                    <?php } 
                    } else { ?>
                        <tr>
                            <td colspan="8" class="text-center">No hay Solicitudes de Material </td>
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
<script src="JS/confirmaciones.js"></script>
</body>