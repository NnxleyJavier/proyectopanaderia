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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 shadow-lg" style="border-radius: 15px;">
                <h2 class="text-warning text-center mb-4">
                    <i class="fas fa-trash-alt"></i> Registro de Mermas
                </h2>
                
             
                    <form role="form" class="Formulario_Mermas" id="Formulario_Mermas" name="Formulario_Mermas" method="POST">
                    
                    <div class="form-group">
                        <label class="text-white font-weight-bold"><i class="fas fa-store"></i> Sucursal</label>
                        <input type="text" class="form-control form-control-lg text-white" style="background-color: rgba(255,255,255,0.1); border: 1px solid #6c757d;" value="<?= isset($nombreSucursal) ? $nombreSucursal : 'Sucursal no detectada' ?>" readonly>
                        
                        <input type="hidden" name="Sucursales_idSucursales" value="<?= isset($idSucursal) ? $idSucursal : '' ?>" required>
                    </div>

                    <div class="form-group mt-3">
                        <label class="text-white font-weight-bold"><i class="fas fa-bread-slice"></i> Producto Mermado</label>
                        <select name="Nombre_Producto" class="form-control form-control-lg" required>
                            <option value="sin_dato">Selecciona un producto...</option>
                            <?php if(isset($Productos) && !empty($Productos)): ?>
                                <?php foreach($Productos as $prod): ?>
                                    <option value="<?= $prod['idProductos'] ?>"><?= $prod['Nombre_Producto'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label class="text-white font-weight-bold"><i class="fas fa-sort-numeric-down"></i> Cantidad (Piezas)</label>
                        <input type="number" name="Conteo_Merma" class="form-control form-control-lg" min="1" placeholder="Ej. 3" required>
                    </div>

                    <div class="form-group mt-5 text-center">
                        <button type="submit" class="btn btn-warning btn-lg px-5 font-weight-bold">
                            <i class="fas fa-save"></i> Registrar Merma
                        </button>
                        <a href="/public/index.php" class="btn btn-outline-light btn-lg ml-2">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('select[name="Nombre_Producto"]').change(function() {
            if ($(this).val() !== "" && $(this).val() !== "sin_dato") {
                $(this).css('border-color', '#28a745');
            } else {
                $(this).css('border-color', '#dc3545');
            }
        });
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../JS/index.js"></script>
</body>
