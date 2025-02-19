

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

        h2 {
            color: #fff;
            width: 100%;
            text-align: center;
        }

    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Registro de Producción</title>
    <link rel="stylesheet" href="CSS/Adaptable.css">
</head>
<body>
   <div class="container-fluid">
    <div class="row">
        <h2>Eliminacion de registros Panadero </h2>
        <?php //var_dump($DataDistribucion)  ?>
        <div class="table-responsive mt-4">
            <table class="table table-bordered bg-success text-white">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>seleccionar</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($TablaProduccionFechaHasProductos)) { 
                        foreach ($TablaProduccionFechaHasProductos as $row) { ?>
                            <tr class="fila">
                                <td><b><?php try {echo htmlspecialchars($row['id']);} catch (Exception $e) {echo "Undefined";} ?></b></td>
                                <td><b><?php try {echo htmlspecialchars($row['Nombre_Producto']);} catch (Exception $e) {echo "Undefined";} ?></b></td>
                                <td><b><?php try {echo htmlspecialchars($row['Cantidad_Realizada']);} catch (Exception $e) {echo "Undefined";} ?></b></td>
                                <td>
                                    <input type="checkbox" name="Confirmacion_Salida" value="1">
                                </td>
                                <td><button type="submit" class="btn btn-primary btn-lg btn-responsive Eliminar_Registro" name="Eliminar_Registro"> <span class="glyphicon glyphicon-floppy-saved"></span> Eliminar </button></td>
                            </tr>
                    <?php } 
                    } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">No hay Solicitudes de Material</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>    </div>
        <br><br>
    </div>
</div>
<script src="JS/index.js"></script>
<script src="JS/confirmaciones.js"></script>
</body>

