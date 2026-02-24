<style>
    /* Tarjeta oscura elegante */
    .card-aurorita {
        background-color: #1e1e1e;
        border: 1px solid #333;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    /* Inputs y Selects oscuros */
    .form-control-dark {
        background-color: #2c2c2c;
        border: 1px solid #444;
        color: #fff;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control-dark:focus {
        background-color: #333;
        border-color: #ffc107; /* Amarillo Aurorita */
        color: #fff;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }

    /* Corrección para opciones de select en algunos navegadores */
    .form-control-dark option {
        background-color: #2c2c2c;
        color: white;
    }

    .form-control-dark::placeholder {
        color: #888;
    }

    /* Estilo de etiquetas */
    .label-style {
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #ddd;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-7"> <div class="text-center mb-4">
                <h2 class="font-weight-bold text-white display-5">
                    <i class="fas fa-flask text-warning mr-2"></i>Receta de Productos
                </h2>
                <p class="text-secondary">Define cuánta materia prima consume cada producto</p>
            </div>

            <div class="card card-aurorita rounded-lg">
                <div class="card-body p-4 p-md-5">
                    
                    <form role="form" class="Formulario_Gasto" id="Formulario_Gasto" name="Formulario_Gasto" method="POST">
                        
                        <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                        <div class="form-group mb-4">
                            <label for="Nombre_Producto" class="label-style font-weight-bold">
                                <i class="fas fa-bread-slice mr-2 text-warning"></i>Producto Terminado (Pan)
                            </label>
                            <select class="form-control form-control-lg form-control-dark" 
                                    name="Nombre_Producto" 
                                    id="Nombre_Producto" 
                                    required>
                                <option value="sin_dato" selected disabled>-- Selecciona el Pan --</option>
                                <?php foreach ($Productos as $row): ?>
                                    <option value="<?php echo $row['idProductos']; ?>">
                                        <?php echo $row['Nombre_Producto']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="Nombre_Producto_de_Almacen" class="label-style font-weight-bold">
                                <i class="fas fa-boxes mr-2 text-info"></i>Materia Prima (Ingrediente)
                            </label>
                            <select class="form-control form-control-lg form-control-dark" 
                                    name="Nombre_Producto_de_Almacen" 
                                    id="Nombre_Producto_de_Almacen" 
                                    required>
                                <option value="sin_dato" selected disabled>-- Selecciona del Almacén --</option>
                                <?php foreach ($Almacen as $row): ?>
                                    <option value="<?php echo $row['idAlmacen']; ?>">
                                        <?php echo $row['Nombre_Materia']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mb-5">
                            <label for="Cantidad_Gasto" class="label-style font-weight-bold">
                                <i class="fas fa-balance-scale mr-2 text-success"></i>Cantidad Utilizada
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       step="0.0000001" 
                                       class="form-control form-control-lg form-control-dark" 
                                       placeholder="Ej. 0.250" 
                                       id="Cantidad_Gasto" 
                                       name="Cantidad_Gasto"
                                       required>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-dark text-muted border-secondary">Unidades</span>
                                </div>
                            </div>
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-info-circle mr-1"></i> Ingrese la cantidad exacta (acepta decimales).
                            </small>
                        </div>

                        <button type="submit" 
                                class="btn btn-primary btn-lg btn-block shadow font-weight-bold" 
                                id="registrar_Cantidades_Gasto">
                            <i class="fas fa-save mr-2"></i> Registrar Micro Gasto
                        </button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../JS/index.js"></script>
</body>


