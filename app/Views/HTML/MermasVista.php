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

    /* Foco con color Rojo para Mermas */
    .form-control-dark:focus {
        background-color: #333;
        border-color: #dc3545; /* Rojo Error/Merma */
        color: #fff;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .form-control-dark option {
        background-color: #2c2c2c;
        color: white;
    }

    .label-style {
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #ddd;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="text-center mb-4">
                <h2 class="font-weight-bold text-white display-5">
                    <i class="fas fa-trash-alt text-danger mr-2"></i>Registro de Mermas
                </h2>
                <p class="text-white">Reporte de sobrantes o producto dañado</p>
            </div>

            <div class="card card-aurorita rounded-lg">
                <div class="card-body p-4 p-md-5">
                    
                    <form role="form" class="Formulario_Mermas" id="Formulario_Mermas" name="Formulario_Mermas" method="POST">
                        
                        <div class="form-group mb-4">
                            <label for="Nombre_Producto" class="label-style font-weight-bold">
                                <i class="fas fa-bread-slice mr-2 text-warning"></i>Producto
                            </label>
                            <select class="form-control form-control-lg form-control-dark" 
                                    name="Nombre_Producto" 
                                    id="Nombre_Producto" 
                                    required>
                                <option value="sin_dato" selected disabled>-- Selecciona el Producto --</option>
                                <?php foreach ($Productos as $row) { ?>
                                    <option value="<?php echo $row['idProductos']; ?>">
                                        <?php echo $row['Nombre_Producto']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="Conteo_Merma" class="label-style font-weight-bold">
                                <i class="fas fa-sort-numeric-down mr-2 text-info"></i>Cantidad (Piezas)
                            </label>
                            <input type="number" 
                                   class="form-control form-control-lg form-control-dark" 
                                   id="Conteo_Merma" 
                                   name="Conteo_Merma" 
                                   placeholder="0"
                                   min="1"
                                   required>
                        </div>

                        <div class="mt-5">
                            <button type="submit" 
                                    class="btn btn-danger btn-lg btn-block shadow font-weight-bold" 
                                    id="MandarRegistroMermas">
                                <i class="fas fa-save mr-2"></i> Registrar Merma
                            </button>
                        </div>

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
