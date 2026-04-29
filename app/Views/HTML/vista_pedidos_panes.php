<head>
    <style>
        /* Estilos oscuros y translúcidos heredados de tu Cabecera */
        .card-custom {
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2); 
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5);
            /* El fondo ya lo da tu Cabecera con rgba(0,0,0,0.65) */
        }
        
        .bg-gradient-bakery {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.7), rgba(30, 126, 52, 0.7));
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Estilo para la tabla transparente */
        .table-dark-custom {
            width: 100%;
            color: #ffffff;
            margin-bottom: 0;
        }
        
        .table-dark-custom th {
            border-top: none;
            border-bottom: 2px solid rgba(74, 227, 107, 0.5); /* Borde verde brillante */
            color: #4ae36b;
            font-weight: 600;
            padding: 15px;
            text-transform: uppercase;
            font-size: 0.9em;
        }
        
        .table-dark-custom td {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px;
            vertical-align: middle;
        }

        .table-dark-custom tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .badge-cantidad {
            font-size: 0.95em;
            padding: 6px 12px;
            border-radius: 8px;
            background-color: rgba(40, 167, 69, 0.8);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            
            <div class="card card-custom shadow-lg">
                <div class="card-header bg-gradient-bakery text-center py-4" style="border-radius: 15px 15px 0 0;">
                    <h3 class="mb-0 text-white"><i class="fas fa-clipboard-list"></i> Pedidos del Día</h3>
                    <p class="mb-0 text-white-50">Mostrando solicitudes para hoy: <?= date('d/m/Y') ?></p>
                </div>

                <div class="card-body p-4">
                    <?php if (!empty($Pedidos)): ?>
                        <div class="table-responsive">
                            <table class="table table-dark-custom text-center">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-user"></i> Cliente</th>
                                        <th><i class="fas fa-cookie-bite"></i> Producto</th>
                                        <th><i class="fas fa-layer-group"></i> Cantidad</th>
                                        <th><i class="fas fa-phone"></i> Teléfono</th>
                                        <th><i class="fas fa-store-alt"></i> Entregar en</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Pedidos as $pedido): ?>
                                        <tr>
                                            <td class="text-left font-weight-bold">
                                                <?= esc($pedido['Nombre_Cliente']) ?>
                                            </td>
                                            <td class="text-left">
                                                <?= esc($pedido['Nombre_Producto']) ?>
                                            </td>
                                            <td>
                                                <span class="badge-cantidad">
                                                    <?= number_format($pedido['Cantidad_requerida']) ?> pzs
                                                </span>
                                            </td>
                                            <td>
                                                <?= !empty($pedido['NumeroTelefono']) ? esc($pedido['NumeroTelefono']) : '<span class="text-muted italic">N/A</span>' ?>
                                            </td>
                                            <td>
                                                <i class="fas fa-map-marker-alt text-success mr-1"></i>
                                                <?= !empty($pedido['SucursalRecoleccion']) ? esc($pedido['SucursalRecoleccion']) : '<span class="text-warning">Sin Asignar</span>' ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-box-open fa-3x mb-3 text-white-50"></i>
                            <h5 class="text-white">No hay pedidos registrados para hoy</h5>
                            <p class="text-white-50">Los pedidos que se agreguen para la fecha actual aparecerán aquí.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-footer bg-transparent text-right py-3" style="border-radius: 0 0 15px 15px; border-top: 1px solid rgba(255,255,255,0.1);">
                    <a href="<?= base_url('Pedidos') ?>" class="btn btn-outline-light">
                        <i class="fas fa-plus-circle"></i> Nuevo Pedido
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>