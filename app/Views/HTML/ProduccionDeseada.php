<link rel="stylesheet" href="../css/Notificacion.css">

<div class="container-fluid dashboard-container">

    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="fecha-header">
                <i class="far fa-calendar-alt mr-2"></i><?php echo $Fecha ?>
            </h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="text-center mb-4 text-secondary">
                <i class="fas fa-bell fa-2x mb-2 text-warning"></i>
                <h4 class="text-white font-weight-light">Panel Diario de Panadería</h4>
            </div>

            <div class="card card-aurorita">
                <div class="card-header-custom" id="headingOne">
                    <h5 class="mb-0 w-100">
                        <button class="btn btn-accordion focus-none" type="button" data-toggle="collapse" data-target="#collapsePedidos" aria-expanded="false" aria-controls="collapsePedidos">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-icon-orders">
                                    <i class="fas fa-shopping-basket"></i>
                                </div>
                                <span>Pedidos Especiales</span>
                            </div>
                            <i class="fas fa-chevron-down text-secondary"></i>
                        </button>
                    </h5>
                </div>

                <div id="collapsePedidos" class="collapse" aria-labelledby="headingOne">
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <?php if (empty($ConsultaPedidos)): ?>
                                <div class="p-4 text-center text-muted">
                                    <i class="fas fa-check-circle mb-2 fa-2x"></i>
                                    <p class="mb-0">No hay pedidos pendientes para hoy.</p>
                                </div>
                            <?php else: ?>
                                <div class="p-3">
                                    <?php foreach ($ConsultaPedidos as $nombre => $cantidad): ?>
                                        <div class="product-list-item">
                                            <span class="text-white font-weight-bold">
                                                <i class="fas fa-bread-slice text-secondary mr-2" style="font-size: 0.8rem;"></i>
                                                <?= $nombre ?>
                                            </span>
                                            <span class="cantidad-badge badge-info shadow-sm text-white">
                                                <?= $cantidad ?> pzs
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-aurorita mt-4">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-icon-production">
                            <i class="fas fa-industry"></i>
                        </div>
                        <h5 class="text-white mb-0 font-weight-bold">Producción Meta</h5>
                    </div>
                </div>

                <div class="card-body p-0">
                    <?php if (empty($datos)): ?>
                        <div class="p-4 text-center text-muted">
                            <i class="fas fa-exclamation-circle mb-2 fa-2x"></i>
                            <p class="mb-0">No se ha definido producción para hoy.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover mb-0">
                                <thead>
                                    <tr class="text-secondary text-uppercase" style="font-size: 0.8rem; background-color: #1a1a1a;">
                                        <th class="pl-4">Producto</th>
                                        <th class="text-center">Meta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datos as $row): ?>
                                        <tr>
                                            <td class="pl-4 align-middle">
                                                <div class="d-flex flex-column">
                                                    <span class="font-weight-bold text-white" style="font-size: 1.1rem;">
                                                        <?= $row['Nombre_Producto'] ?>
                                                    </span>
                                                    <small class="text-muted">
                                                     
                                                    </small>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="cantidad-badge badge-success shadow">
                                                    <?= $row['Cantidad_requerida'] ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../JS/index.js"></script>

<script>
    // Pequeño script para rotar la flecha cuando se abre/cierra el acordeón
    $('#collapsePedidos').on('show.bs.collapse', function () {
        $(".fa-chevron-down").css("transform", "rotate(180deg)");
    });
    $('#collapsePedidos').on('hide.bs.collapse', function () {
        $(".fa-chevron-down").css("transform", "rotate(0deg)");
    });
</script>