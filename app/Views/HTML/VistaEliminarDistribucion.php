<div class="container mt-5 mb-5">
    <div class="card p-4 shadow-lg" style="border-radius: 15px;">
        <h3 class="text-danger text-center mb-4">
            <i class="fas fa-eraser"></i> Corregir / Eliminar Distribución de Hoy
            <br><small class="text-light" style="font-size: 0.6em;">Fecha: <?= date("d/m/Y", strtotime($fechaHoy)) ?></small>
        </h3>
        
        <div class="alert alert-warning text-center">
            <i class="fas fa-exclamation-triangle"></i> <strong>Atención:</strong> Si eliminas un registro aquí, desaparecerá permanentemente del reporte de la sucursal.
        </div>

        <div class="table-responsive mt-3 bg-light rounded p-2">
            <table class="table table-hover table-bordered table-sm">
                <thead class="bg-danger text-white text-center">
                    <tr>
                        <th>Sucursal</th>
                        <th>Producto</th>
                        <th>Cantidad Enviada</th>
                        <th>Estatus en Sucursal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($distribuciones)): ?>
                        <?php foreach($distribuciones as $fila): ?>
                        <tr>
                            <td class="font-weight-bold text-dark align-middle"><?= $fila['NombreSucursal'] ?></td>
                            <td class="text-dark align-middle"><?= $fila['Nombre_Producto'] ?></td>
                            <td class="text-center text-primary font-weight-bold align-middle" style="font-size: 1.1em;">
                                <?= $fila['Cantidad_Salida'] ?>
                            </td>
                            
                            <td class="text-center align-middle">
                                <?php if($fila['Confirmacion_Salida'] !== null): ?>
                                    <span class="badge badge-success"><i class="fas fa-check-double"></i> Ya fue recibido</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary"><i class="fas fa-clock"></i> Pendiente</span>
                                <?php endif; ?>
                            </td>

                     <td class="text-center align-middle">
                        <form action="/EliminarRegistroDistribucion" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás completamente seguro de eliminar este envío de <?= $fila['Cantidad_Salida'] ?> <?= $fila['Nombre_Producto'] ?> para <?= $fila['NombreSucursal'] ?>?');">
                            
                            <input type="hidden" name="idSalida" value="<?= $fila['idSalida_Mercancia'] ?>">
                            
                            <button type="submit" class="btn btn-danger btn-sm font-weight-bold">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                    </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-dark py-5">
                                <i class="fas fa-check-circle fa-3x text-success mb-3"></i><br>
                                <h5>No hay registros de distribución el día de hoy o ya fueron borrados.</h5>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?= base_url('/index.php') ?>" class="btn btn-outline-light"><i class="fas fa-arrow-left"></i> Volver al Menú Principal</a>
        </div>
    </div>
</div>