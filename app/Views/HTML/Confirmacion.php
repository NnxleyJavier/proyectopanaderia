<head>
    <style>
        .table-responsive { overflow-x: auto; }
        .table th, .table td { vertical-align: middle !important; }
        .card-custom { border-radius: 15px; border: none; }
        
        /* Hacemos el checkbox más grande y fácil de clickear en celulares */
        .check-grande {
            transform: scale(1.5);
            cursor: pointer;
        }
        
        .bg-gradient-primary { background: linear-gradient(135deg, #007bff, #0056b3); }
        .bg-gradient-success { background: linear-gradient(135deg, #28a745, #1e7e34); }
    </style>
</head>

<body>

<div class="container mt-5 mb-5">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-custom shadow-lg mb-5">
                
                <div class="card-header bg-gradient-primary text-white text-center py-3" style="border-radius: 15px 15px 0 0;">
                    <h3 class="mb-0"><i class="fas fa-truck-loading"></i> Confirmación de Distribución</h3>
                    <small>Verifica las cantidades recibidas antes de aceptar</small>
                </div>

                <div class="card-body p-4 bg-light">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered bg-white shadow-sm mb-0" style="border-radius: 8px; overflow: hidden;">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>ID_Control</th>
                                    <th>Nombre del Producto</th>
                                    <th>Cantidad Enviada</th>
                                    <th>Nota / Comentarios</th>
                                    <th>Validar</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($DataDistribucion)): ?>
                                    <?php foreach ($DataDistribucion as $item): ?>
                                        <tr class="fila">
                                            
                                            <td class="align-middle font-weight-bold text-muted">
                                                <?php try { echo htmlspecialchars($item['idSalida_Mercancia']); } catch (Exception $e) { echo "Undefined"; } ?>
                                            </td>
                                            
                                            <td class="align-middle font-weight-bold text-dark" style="font-size: 1.1em;">
                                                <?php try { echo htmlspecialchars($item['Nombre_Producto']); } catch (Exception $e) { echo "Undefined"; } ?>
                                            </td>
                                            
                                            <td class="align-middle font-weight-bold text-primary" style="font-size: 1.3em;">
                                                <?php try { echo htmlspecialchars($item['Cantidad_Salida']); } catch (Exception $e) { echo "Undefined"; } ?>
                                            </td>

                                            <td class="align-middle"> 
                                                <input type="text" name="comentarios" class="form-control" placeholder="Ej. Faltaron 2 piezas..." style="border-radius: 8px;">
                                            </td>
                                            
                                            <td class="align-middle">
                                                <div class="custom-control custom-checkbox mt-2">
                                                    <input type="checkbox" class="check-grande" name="Confirmacion_Salida" value="1">
                                                </div>
                                            </td>
                                            
                                            <td class="align-middle">
                                                <button type="submit" class="btn btn-primary font-weight-bold registrar_Confirmacion shadow-sm" name="registrar_Confirmacion" style="border-radius: 8px;"> 
                                                    <i class="fas fa-check-circle"></i> Aceptar
                                                </button>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fas fa-clipboard-check fa-3x mb-3 text-success"></i><br>
                                            <h5>¡Todo al día! No hay mercancía pendiente por validar.</h5>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-custom shadow border-0">
                <div class="card-header bg-gradient-success text-white text-center py-3" style="border-radius: 15px 15px 0 0;">
                    <h4 class="mb-0"><i class="fas fa-check-double"></i> Recepciones Confirmadas Hoy</h4>
                </div>
                
                <div class="card-body bg-light p-4">
                    <?php if (!empty($DataVerificados)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered bg-white shadow-sm mb-0">
                                <thead class="bg-success text-white text-center">
                                    <tr>
                                        <th>ID_Control</th>
                                        <th>Producto Recibido</th>
                                        <th>Cantidad</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($DataVerificados as $verificado): ?>
                                        <tr>
                                            <td class="align-middle text-center text-muted font-weight-bold">
                                                <?= $verificado['idSalida_Mercancia'] ?? '-' ?>
                                            </td>
                                            <td class="align-middle text-dark font-weight-bold" style="font-size: 1.1em;">
                                                <i class="fas fa-bread-slice text-secondary mr-2"></i> <?= $verificado['Nombre_Producto'] ?? 'Producto Desconocido' ?>
                                            </td>
                                            <td class="align-middle text-center text-success font-weight-bold" style="font-size: 1.2em;">
                                                <?= $verificado['Cantidad_Salida'] ?? 0 ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-success px-3 py-2" style="font-size: 0.9em; border-radius: 20px;">
                                                    <i class="fas fa-check"></i> Recibido
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-info-circle fa-2x mb-2"></i>
                            <p class="mb-0">Aún no has confirmado ninguna recepción el día de hoy.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../JS/index.js"></script>
<script src="../JS/ayuda.js"></script>

