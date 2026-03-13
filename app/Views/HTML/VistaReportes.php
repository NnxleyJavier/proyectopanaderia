<div class="container mt-4 mb-5">
    
    <div class="card p-4 shadow-lg" style="border-radius: 15px;">
        <h3 class="text-white text-center mb-2"><i class="fas fa-hand-holding-usd"></i> Reporte de Distribución y Ventas</h3>
        
        <div class="row justify-content-center mt-3 mb-4">
            <div class="col-md-8 bg-dark p-3 rounded shadow" style="border: 1px solid #444;">
                <form action="/Dasboard" method="POST" class="form-inline justify-content-center">
                    <label class="text-white font-weight-bold mr-3"><i class="fas fa-calendar-alt"></i> Buscar Fecha:</label>
                    <input type="date" name="fecha_reporte" class="form-control mr-3" value="<?= $fechaHoy ?>" max="<?= date('Y-m-d') ?>" required>
                    <button type="submit" class="btn btn-warning font-weight-bold">
                        <i class="fas fa-search"></i> Consultar
                    </button>
                </form>
            </div>
        </div>

        <?php 
        $resumenSucursales = [];
        $granTotalDia = 0;
        
        if(!empty($reporteDiario)){
            foreach($reporteDiario as $fila){
                $precio = (float)$fila['Valor_Venta'];
                $distribucion = (int)$fila['Cantidad_Salida'];
                $mermas = (int)($fila['Total_Merma'] ?? 0);
                
                $piezas = $distribucion - $mermas;
                if($piezas < 0) $piezas = 0; 
                
                $total = $piezas * $precio;
                
                $sucursal = $fila['NombreSucursal'];
                if(!isset($resumenSucursales[$sucursal])){
                    $resumenSucursales[$sucursal] = 0;
                }
                $resumenSucursales[$sucursal] += $total;
                $granTotalDia += $total;
            }
        }
        ?>

        <?php if(!empty($resumenSucursales)): ?>
        <div class="row mb-4 justify-content-center">
            <div class="col-12 text-center">
                <h4 class="text-warning mb-3"><i class="fas fa-wallet"></i> Resumen de Cobro del día: <?= date("d/m/Y", strtotime($fechaHoy)) ?></h4>
            </div>
            
            <?php foreach($resumenSucursales as $nombre => $total): ?>
            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white text-center p-3 shadow-sm border-0" style="border-radius: 12px;">
                    <h5 class="mb-1"><i class="fas fa-store"></i> <?= $nombre ?></h5>
                    <h2 class="font-weight-bold mb-0">$<?= number_format($total, 2) ?></h2>
                    <small class="text-light">A cobrar</small>
                </div>
            </div>
            <?php endforeach; ?>
            
            <div class="col-md-4 mb-3">
                <div class="card text-white text-center p-3 shadow-sm border-0" style="background-color: #004085; border-radius: 12px;">
                    <h5 class="mb-1"><i class="fas fa-cash-register"></i> TOTAL DEL DÍA</h5>
                    <h2 class="font-weight-bold text-warning mb-0">$<?= number_format($granTotalDia, 2) ?></h2>
                    <small class="text-light">Ingreso proyectado</small>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <h4 class="text-white mt-2"><i class="fas fa-list"></i> Desglose de Distribución y Mermas</h4>
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
                        <th>Subtotal Fila</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $subtotalSucursal = 0; 
                    $sucursalActual = null; 
                    
                    if(!empty($reporteDiario)): 
                        foreach($reporteDiario as $fila): 
                            
                            // Separador de Sucursales en la tabla
                            if ($sucursalActual !== null && $sucursalActual !== $fila['NombreSucursal']) {
                                ?>
                                <tr class="table-secondary">
                                    <td colspan="7" class="text-right font-weight-bold text-dark">
                                        Subtotal <?= $sucursalActual ?>:
                                    </td>
                                    <td class="text-right font-weight-bold text-primary" style="font-size: 1.1em;">
                                        $<?= number_format($subtotalSucursal, 2) ?>
                                    </td>
                                </tr>
                                <?php
                                $subtotalSucursal = 0; 
                            }
                            
                            $sucursalActual = $fila['NombreSucursal'];

                            // Cálculos de la fila
                            $precio = (float)$fila['Valor_Venta'];
                            $distribucion = (int)$fila['Cantidad_Salida'];
                            $mermas = (int)($fila['Total_Merma'] ?? 0);
                            
                            $piezasCobrables = $distribucion - $mermas;
                            if($piezasCobrables < 0) $piezasCobrables = 0; 
                            
                            $totalFila = $piezasCobrables * $precio;
                            $subtotalSucursal += $totalFila;
                    ?>
                        <tr>
                            <td class="font-weight-bold text-dark align-middle"><?= $fila['NombreSucursal'] ?></td>
                            <td class="text-dark align-middle">
                                <?= !empty($fila['Categoria']) ? $fila['Categoria'] : $fila['Nombre_Producto'] ?>
                            </td>
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
                            
                            <td class="text-right font-weight-bold text-dark align-middle">
                                $<?= number_format($totalFila, 2) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if ($sucursalActual !== null): ?>
                            <tr class="table-secondary">
                                <td colspan="7" class="text-right font-weight-bold text-dark">
                                    Subtotal <?= $sucursalActual ?>:
                                </td>
                                <td class="text-right font-weight-bold text-primary" style="font-size: 1.1em;">
                                    $<?= number_format($subtotalSucursal, 2) ?>
                                </td>
                            </tr>
                        <?php endif; ?>

                    <?php else: ?>
                        <tr><td colspan="8" class="text-center text-dark py-4">No hay salidas registradas para esta fecha.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>