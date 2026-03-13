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
                            <th class="text-center">Usuario que registró</th> 
                            <th>IdMermas</th> 
                            <th class="text-end pe-4">Acciones</th>
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
     
         <a href="#" class="btn btn-sm btn-outline-danger" 
           title="Eliminar"
           data-toggle="modal" 
           data-target="#modalEliminar"
           data-id="<?= $merma['idSupervision'] ?>" 
           data-cantidad="<?= $merma['Conteo_Merma'] ?>"
           data-nombre="<?= $merma['Nombre_Producto'] ?? 'Producto Desconocido' ?>">
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




<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-dark">
      
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalEliminarLabel">Dar de Baja Merma</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
          <div class="alert alert-info py-2 text-center" style="font-size: 0.9em;">
              <i class="fas fa-info-circle"></i> Esta acción se registrará en el historial final y <strong>no afectará</strong> tu reporte global del día.
          </div>

          <form id="FormEliminarMerma" class="Eliminarmermas" method="POST" action="<?= base_url('/ActualizarMermas') ?>">
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                
                <input type="hidden" name="tipo_baja" value="NO"> <!-- 0 para baja sin repercusión, 1 para baja con repercusión -->

                <div class="form-group">
                    <label for="idMermaEliminar" class="col-form-label font-weight-bold text-dark">ID Merma:</label>
                    <input type="text" class="form-control" id="idMermaEliminar" name="id_merma" readonly style="background-color: #e9ecef;">
                </div>

                <div class="form-group">
                    <label for="Razon_baja" class="col-form-label font-weight-bold text-dark">Razón de la baja:</label>
                    <textarea class="form-control" id="Razon_baja" placeholder="Ej: Panes Descompuestos o Aplastados" rows="3" name="razon_eliminacion" required></textarea>
                </div> 
                
                <div class="form-group">
                    <label for="Cantidad_Baja" class="col-form-label font-weight-bold text-dark">Número de mermas a retirar:</label>
                    <input class="form-control" id="Cantidad_Baja" min="1" type="number" name="cantidad" required>
                    <small class="form-text text-muted mt-1">
                        Cantidad máxima registrada en este ID: <span id="maxCantidadText" class="font-weight-bold text-danger"></span>
                    </small>
                </div>
        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="FormEliminarMerma" class="btn btn-danger">Confirmar Baja</button>
      </div>
  </div>
 </div>
</div>

<script>
  

        // ----------------------------------------------------
    // SCRIPT PARA EL MODAL DE BAJA / ELIMINAR MERMA
    // ----------------------------------------------------
    $('#modalEliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        
        var idRecibido = button.data('id');
        var cantidadRecibida = button.data('cantidad');
        
        var modal = $(this);
        
        modal.find('.modal-body #idMermaEliminar').val(idRecibido);
        
        var inputCantidad = modal.find('.modal-body #Cantidad_Baja');
        inputCantidad.val(cantidadRecibida); 
        inputCantidad.attr('max', cantidadRecibida); 
        
        modal.find('#maxCantidadText').text(cantidadRecibida);
        modal.find('.modal-body #Razon_baja').val('');
    });

    // ----------------------------------------------------
    // EVITAR QUE CAMBIE DE PÁGINA AL ELIMINAR (USANDO AJAX)
    // ----------------------------------------------------
    $('#FormEliminarMerma').submit(function(e) {
        e.preventDefault(); // <-- Esto evita que el navegador cambie de página

        var form = $(this);
        var url = form.attr('action');

        // Enviamos los datos "por debajo"
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(response) {
                // 1. Escondemos el modal
                $('#modalEliminar').modal('hide');
                
                // 2. Recargamos la página actual para que la tabla se actualice sola
                location.reload();
            },
            error: function() {
                alert("Ocurrió un error al procesar la baja. Por favor intenta de nuevo.");
            }
        });
    });


    
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../JS/index.js"></script>

</body>
</html>