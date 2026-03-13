
<style>
    /* Fondo de la tarjeta del formulario */
    .card-aurorita {
        background-color: #1e1e1e; /* Gris oscuro elegante */
        border: 1px solid #333;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Sombra suave */
    }

    /* Estilo de los Inputs y Selects */
    .form-control-dark {
        background-color: #2c2c2c;
        border: 1px solid #444;
        color: #fff; /* Texto blanco */
        transition: all 0.3s ease;
    }

    /* Efecto al hacer clic en un input */
    .form-control-dark:focus {
        background-color: #333;
        border-color: #ffc107; /* Amarillo Aurorita */
        color: #fff;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }

    /* Para que las opciones del select no salgan blancas en algunos navegadores */
    .form-control-dark option {
        background-color: #2c2c2c;
        color: white;
    }

    /* Color del placeholder (texto de ayuda) */
    .form-control-dark::placeholder {
        color: #888;
    }
    /* Estilo para párrafos */
    .card-body p {
        color: #e0e0e0;
    }

    p {
        color: #e0e0e0;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="text-center mb-4">
                <h2 class="font-weight-bold text-white display-5">
                    <i class="fas fa-tools text-warning mr-2"></i>Registro de Utilerías
                </h2>
                <p >Solicitud de herramientas y materiales de almacén</p>
                
                <div class="mt-2">
                    <span class="badge badge-dark border border-secondary p-2 shadow-sm">
                        <i class="far fa-calendar-alt text-info mr-1"></i> 
                        Fecha: <span class="text-white"><?php echo $fecha; ?></span>
                    </span>
                </div>
            </div>

            <div class="card card-aurorita rounded-lg">
                <div class="card-body p-4 p-md-5">
                    
                    <form role="form" class="Formulario_Utileria" id="Formulario_Utileria" name="Formulario_Utileria" method="POST">
                        
                        <div class="form-group mb-4">
                            <label for="Cantidad_Pedido" class="font-weight-bold text-light small text-uppercase spacing-1">
                                <i class="fas fa-sort-amount-up mr-1 text-warning"></i> Cantidad a Pedir
                            </label>
                            <input type="number" 
                                   class="form-control form-control-lg form-control-dark" 
                                   id="Cantidad_Pedido" 
                                   name="Cantidad_Pedido" 
                                   placeholder="Ej. 10 piezas" 
                                   min="1" 
                                   required>
                        </div>
                    
                        <div class="form-group mb-4">
                            <label for="almacen_idAlmacen" class="font-weight-bold text-light small text-uppercase spacing-1">
                                <i class="fas fa-box-open mr-1 text-warning"></i> Producto del Almacén
                            </label>
                            <select class="form-control form-control-lg form-control-dark" 
                                    id="almacen_idAlmacen" 
                                    name="almacen_idAlmacen" 
                                    required>
                                <option value="sin_dato" disabled selected>-- Selecciona un material --</option>
                                <?php foreach ($Almacen as $row): ?>
                                    <option value="<?php echo $row['idAlmacen']; ?>">
                                        <?php echo $row['Nombre_Materia']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <input type="hidden" name="users_id" value="<?php echo $user_id; ?>">

                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary btn-lg btn-block shadow font-weight-bold">
                                <i class="fas fa-save mr-2"></i> Registrar Solicitud
                            </button>
                            
                            <a href="<?= base_url('/index.php') ?>" class="btn btn-outline-secondary btn-block mt-3 border-0">
                                Cancelar operación
                            </a>
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