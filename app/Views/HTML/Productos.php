<style>
    /* Tarjeta oscura elegante */
    .card-aurorita {
        background-color: #1e1e1e;
        border: 1px solid #333;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    /* Inputs oscuros */
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
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="text-center mb-4">
                <h2 class="font-weight-bold text-white display-5">
                    <i class="fas fa-tags text-warning mr-2"></i>Nuevo Producto
                </h2>
                <p class="text-secondary">Registra un nuevo pan o artículo para la venta</p>
            </div>

            <div class="card card-aurorita rounded-lg">
                <div class="card-body p-4 p-md-5">
                    
                    <form role="form" class="Formulario_Producto" id="Formulario_Producto" name="Formulario_Producto" method="POST">
                        
                        <div class="form-group mb-4">
                            <label for="Nombre_Producto" class="label-style font-weight-bold">
                                <i class="fas fa-bread-slice mr-2 text-warning"></i>Nombre del Producto
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg form-control-dark" 
                                   placeholder="Ej. Concha de Vainilla" 
                                   id="Nombre_Producto" 
                                   name="Nombre_Producto"
                                   required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="Categoria" class="label-style font-weight-bold">
                                <i class="fas fa-layer-group mr-2 text-info"></i>Categoría
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg form-control-dark" 
                                   placeholder="Ej. Pan Dulce / Bollería" 
                                   id="Categoria" 
                                   name="Categoria"
                                   required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="Valor_produccion" class="label-style font-weight-bold">
                                        <i class="fas fa-industry mr-2 text-secondary"></i>Costo Producción
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-dark border-secondary text-white">$</span>
                                        </div>
                                        <input type="number" 
                                               step="0.01"
                                               class="form-control form-control-lg form-control-dark" 
                                               placeholder="0.00" 
                                               id="Valor_produccion" 
                                               name="Valor_produccion"
                                               required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="Valor_Venta" class="label-style font-weight-bold">
                                        <i class="fas fa-tag mr-2 text-success"></i>Precio Venta
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-dark border-secondary text-white">$</span>
                                        </div>
                                        <input type="number" 
                                               step="0.01"
                                               class="form-control form-control-lg form-control-dark" 
                                               placeholder="0.00" 
                                               id="Valor_Venta" 
                                               name="Valor_Venta"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        </div>

                        <div class="mt-4">
                            <button type="submit" 
                                    class="btn btn-primary btn-lg btn-block shadow font-weight-bold" 
                                    id="registrar_Incremento_Almacen">
                                <i class="fas fa-save mr-2"></i> Agregar Producto
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="../JS/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
