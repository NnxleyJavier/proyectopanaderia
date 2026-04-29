<head>
    <style>
        /* Ajustes respetando el tema oscuro de Cabecera.php */
        .card-custom {
            border-radius: 15px;
            /* Eliminamos el background blanco para que herede el rgba(0, 0, 0, 0.65) de tu Cabecera */
            border: 1px solid rgba(255, 255, 255, 0.2); 
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5);
        }
        
        .bg-gradient-bakery {
            /* Un verde oscuro semi-transparente que combina con el fondo negro */
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.7), rgba(30, 126, 52, 0.7));
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            /* El color blanco ya lo hereda de la etiqueta label en tu Cabecera.php */
        }
        
        .form-label i {
            margin-right: 8px;
            color: #4ae36b; /* Un verde más brillante para que resalte en el fondo oscuro */
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px;
            /* Entradas de texto ligeramente opacas para buen contraste */
            background-color: rgba(255, 255, 255, 0.9); 
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #333;
        }
        
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.5);
            background-color: #ffffff;
        }
        
        .btn-enviar {
            background: linear-gradient(135deg, #28a745, #218838);
            border: none;
            border-radius: 10px;
            padding: 15px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: transform 0.2s;
            color: white;
        }
        
        .btn-enviar:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
            color: white;
        }
    </style>
</head>

<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            
            <div class="card card-custom shadow-lg">
                <div class="card-header bg-gradient-bakery text-center py-4" style="border-radius: 15px 15px 0 0;">
                    <h2 class="mb-0"><i class="fas fa-bread-slice"></i> Gestión de Pedidos</h2>
                    <p class="mb-0 text-white-50">Panadería Aurorita - Registro de Solicitudes</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form role="form" class="Formulario_Pedidos" id="Formulario_Pedidos" name="Formulario_Pedidos" method="POST">
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="cliente"><i class="fas fa-user"></i> Nombre del Cliente:</label>
                                <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Agregar Nombre" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="Nombre_Producto"><i class="fas fa-cookie-bite"></i> Producto:</label>
                                <select class="form-control" name="Nombre_Producto" id="Nombre_Producto" required>
                                    <option value="" disabled selected>Nombre de Producto</option>
                                    <?php foreach ($Productos as $row): ?>
                                        <option value="<?= $row['idProductos']; ?>"><?= esc($row['Nombre_Producto']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="cantidad"><i class="fas fa-layer-group"></i> Cantidad:</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Agregar Cantidad" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="telefono"><i class="fas fa-phone"></i> Número de Teléfono:</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Agregar Número de Teléfono">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="fecha"><i class="fas fa-calendar-alt"></i> Fecha:</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?= date('Y-m-d'); ?>" required>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label" for="sucursal_recoleccion"><i class="fas fa-store-alt"></i> Sucursal para recoger el pedido:</label>
                                <select class="form-control" name="sucursal_recoleccion" id="sucursal_recoleccion" required>
                                    <option value="" disabled selected>--- Seleccione una sucursal ---</option>
                                    <?php if (!empty($Sucursales)): ?>
                                        <?php foreach ($Sucursales as $sucursal): ?>
                                            <option value="<?= $sucursal['idSucursales'] ?>">
                                                <?= esc($sucursal['NombreSucursal']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success btn-lg btn-block btn-enviar" id="MandarPedido">
                                <span class="glyphicon glyphicon-floppy-saved"></span> <i class="fas fa-save mr-2"></i> Agregar Pedido
                            </button>
                        </div>

                    </form>
                </div>

                <div class="card-footer bg-transparent text-center py-3" style="border-radius: 0 0 15px 15px; border-top: 1px solid rgba(255,255,255,0.1);">
                    <small class="text-white-50">&copy; 2026 Panadería Aurorita</small>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../JS/index.js"></script>
</body>