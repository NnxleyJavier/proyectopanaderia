<div class="container mt-4">
    <div class="card p-4">
        <h3 class="text-white"><i class="fas fa-hand-holding-usd"></i> Reporte de Distribución y Ventas</h3>
        
        <div class="table-responsive mt-3 bg-light rounded p-2">
            <table class="table table-hover table-bordered table-sm">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>Sucursal</th>
                        <th>Producto</th>
                        <th>Precio Unit.</th>
                        <th>Distribución</th>
                        <th>Confirmado</th>
                        <th>Mermas</th>
                        <th>Notas</th>
                        <th>Total a Cobrar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $granTotalDia = 0; // Variable para sumar todo el dinero del día
                    
                    if(!empty($reporteDiario)): 
                        foreach($reporteDiario as $fila): 
                            // 1. Convertimos los valores a números (si Total_Merma es null, lo hacemos 0)
                            $precio = (float)$fila['Valor_Venta'];
                            $distribucion = (int)$fila['Cantidad_Salida'];
                            $mermas = (int)($fila['Total_Merma'] ?? 0);
                            
                            // 2. Aplicamos tu fórmula: (Distribución - Mermas) * Precio
                            $piezasCobrables = $distribucion - $mermas;
                            // Prevenir números negativos por error de captura
                            if($piezasCobrables < 0) $piezasCobrables = 0; 
                            
                            $totalFila = $piezasCobrables * $precio;
                            
                            // 3. Sumamos al Gran Total
                            $granTotalDia += $totalFila;
                    ?>
                        <tr>
                            <td class="font-weight-bold text-dark align-middle"><?= $fila['NombreSucursal'] ?></td>
                            <td class="text-dark align-middle"><?= $fila['Nombre_Producto'] ?></td>
                            <td class="text-center align-middle">$<?= number_format($precio, 2) ?></td>
                            <td class="text-center text-primary font-weight-bold align-middle"><?= $distribucion ?></td>
                            
                            <td class="text-center align-middle">
                                <?php if($fila['Confirmacion_Salida'] !== null): ?>
                                    <span class="badge badge-success" style="font-size: 0.9em;">
                                        <?= $fila['Confirmacion_Salida'] ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-warning">Pendiente</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center align-middle font-weight-bold <?= $mermas > 0 ? 'text-danger' : 'text-success' ?>">
                                <?= $mermas ?>
                            </td>
                            
                            <td class="text-dark text-muted align-middle" style="font-size: 0.85em;">
                                <?= !empty($fila['Nota']) ? $fila['Nota'] : '-' ?>
                            </td>
                            
                            <td class="text-right font-weight-bold text-success align-middle" style="font-size: 1.1em;">
                                $<?= number_format($totalFila, 2) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <tr class="table-active">
                            <td colspan="7" class="text-right font-weight-bold h5 text-dark">GRAN TOTAL DEL DÍA:</td>
                            <td class="text-right font-weight-bold h5 text-success">$<?= number_format($granTotalDia, 2) ?></td>
                        </tr>

                    <?php else: ?>
                        <tr><td colspan="8" class="text-center text-dark py-4">No hay salidas registradas para el día de hoy.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>