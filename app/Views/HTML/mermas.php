
</head>
<body>
<div class="container-fluid py-5">
    
    <div class="row align-items-center mb-4">
        <div class="col-12 col-md-6">
            <h2 class="text-white fw-bold display-6">
                <i class="fas fa-boxes text-info me-2"></i> Gestión de Mermas
            </h2>
            <p class="text-secondary mb-0">Administración y control de pérdidas</p>
        </div>
        <div class="col-12 col-md-6 text-md-end mt-3 mt-md-0">
            <a href="<?= base_url('/mermas') ?>" class="btn btn-primary btn-lg shadow px-4">
                <i class="fas fa-plus me-2"></i>Nueva Merma
            </a>
        </div>
    </div>

    <div class="card bg-dark border-secondary shadow-lg">
        <div class="card-header bg-transparent border-secondary py-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-white h5 mb-0">Listado Reciente</span>
                <span class="badge bg-secondary">Total: <?= count($ListaMermas) ?></span>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover table-striped mb-0 align-middle">
                    <thead class="text-uppercase text-secondary fs-7" style="background-color: #1a1a1a;">
                        <tr>
                            <th class="ps-4 py-3">CANTIDAD DE MERMA</th>
                            <th>NOMBRE DE PRODUCTO</th>
                            <th class="text-center">Usuario que registró</th> <th>IdMermas</th> <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="border-secondary">
                        <?php if (!empty($ListaMermas)): ?>
                            <?php foreach ($ListaMermas as $merma): ?>
            
                                <tr>                    
            <td class="ps-4 text-center" style="font-size: larger;">
                <span class="badge bg-warning text-dark fs-6 rounded-pill border border-warning" 
                style="box-shadow: 0 0 10px rgba(255, 193, 7, 0.6);">
                Piezas de pan: <?= $merma['Conteo_Merma'] ?>
                </span>
            </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="text-white fw-semibold">
                                                <?= $merma['Nombre_Producto'] ?? 'Producto Desconocido' ?>
                                            </span>
                                            <small class="text-muted">
                                                ID-PRODUCTO: <?= $merma['productos_idProductos'] ?>
                                            </small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary bg-opacity-25 text-light border border-secondary">
                                            <i class="fas fa-user me-1"></i> <?= $merma['username'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-light text-opacity-75 d-inline-block text-truncate" style="max-width: 150px;">
                                            <?= $merma['idSupervision'] ?? 'N/A' ?>
                                        </span>
                                    </td>
                                  <td class="text-end pe-4">
    <div class="btn-group" role="group">
        <a href="#" class="btn btn-sm btn-outline-info Editarmermas" 
           title="Editar" 
           data-toggle="modal" 
           data-target="#modalEditar"
           data-id="<?= $merma['idSupervision'] ?>" 
         data-cantidad="<?= $merma['Conteo_Merma'] ?>"
           >

           
            <i class="fas fa-pen"></i>
        </a>
        
        <a href="#" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar registro?')" title="Eliminar">
            <i class="fas fa-trash"></i>
        </a>
    </div>
</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center text-muted">
                                        <i class="fas fa-search fa-3x mb-3 opacity-50"></i>
                                        <h5 class="fw-normal">No hay datos disponibles</h5>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-dark">
      
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Editar Información</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        
          <form id="FormEditarMerma" class="Actualizarmermas" method="POST" action="<?= base_url('/ActualizarMermas') ?>">
                
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                <div class="form-group">
                <label for="idMermaInput" class="col-form-label font-weight-bold text-dark">ID Merma:</label>
                <input type="text" class="form-control" id="idMermaInput" name="id_merma" readonly style="background-color: #e9ecef;">
            </div>

            <div class="form-group">
                <label for="Razon_eliminacion" class="col-form-label font-weight-bold text-dark">Razón de la eliminación:</label>
                <textarea class="form-control" id="Razon_eliminacion" placeholder="Ej: Panes Descompuestos" rows="3" name="razon_eliminacion"></textarea>
            </div> 
            <div class="form-group">
                <label for="Cantidad_Eliminar" class="col-form-label font-weight-bold text-dark">Número de mermas:</label>
                <input class="form-control" id="Cantidad_Eliminar" min="1" placeholder="Ej: 5" type="number" name="cantidad">
            </div>
        </form>
      </div>
      
      <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
  
  <button type="submit" form="FormEditarMerma" class="btn btn-primary">
      Guardar Cambios
  </button>
      
    </div>
  </div>
</div>

<script>
    $('#modalEditar').on('show.bs.modal', function (event) {
        // 1. 'button' es el elemento específico (el lápiz) que se presionó
        var button = $(event.relatedTarget); 
        
        // 2. Extraemos los datos de los atributos data-*
        var idRecibido = button.data('id');
        var cantidadRecibida = button.data('cantidad');
        
        // 3. Asignamos los valores a los inputs del modal
        var modal = $(this);
        
        // Ponemos el ID en el input gris (readonly)
        modal.find('.modal-body #idMermaInput').val(idRecibido);
        
        // (Opcional) Si quieres que aparezca la cantidad que ya tenía
        modal.find('.modal-body #Cantidad_Eliminar').val(cantidadRecibida);
    });
</script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../JS/index.js"></script>


</body>
</html>