<nav class="navbar navbar-expand-lg navbar-dark bg-transparent border-bottom border-secondary">
    <a class="navbar-brand" href="<?= base_url('') ?>">
        <i class="fas fa-bread-slice text-warning"></i> Aurorita
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('') ?>"><i class="fas fa-home"></i> Home</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdmin" role="button" data-toggle="dropdown">
                    <i class="fas fa-user-shield"></i> Administración
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
                    <h6 class="dropdown-header">Almacén</h6>
                    <a class="dropdown-item" href="<?= base_url('paginaprincipal') ?>">Registro Almacén</a>
                    <a class="dropdown-item" href="<?= base_url('Corroborar') ?>">Corroborar Almacén</a>
                    <a class="dropdown-item" href="<?= base_url('producto') ?>">Registro de Productos</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Gestión</h6>
                    <a class="dropdown-item" href="<?= base_url('Uso_Materia_Prima') ?>">Uso de Materia Prima</a>
                    <a class="dropdown-item" href="<?= base_url('Produccion_Deseada_admin') ?>">Actualizar Prod. Deseada</a>
                    <a class="dropdown-item" href="<?= base_url('PedidosdeMaterialConfirmacion') ?>">Envío de Utilería</a>
                    <a class="dropdown-item" href="<?= base_url('VistaReportes') ?>">Consultar Reporte Ventas.</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProd" role="button" data-toggle="dropdown">
                    <i class="fas fa-industry"></i> Producción
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownProd">
                    <h6 class="dropdown-header">Producción</h6>
                    <a class="dropdown-item" href="<?= base_url('Produccion_Deseada') ?>">Ver Producción Deseada</a>
                    <a class="dropdown-item" href="<?= base_url('Vista_Produccion_Real') ?>">Registro Producción Real</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Logística / Conteo</h6>
                    <a class="dropdown-item" href="<?= base_url('Vista_Produccion_Registrado') ?>">Registro de Distribución</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Reportes</h6>
                    <a class="dropdown-item" href="<?= base_url('GenerarReporteProduccion') ?>">Generar Reporte Prod.</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownVentas" role="button" data-toggle="dropdown">
                    <i class="fas fa-cash-register"></i> Ventas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownVentas">
                    <h6 class="dropdown-header">Pedidos</h6>
                    <a class="dropdown-item" href="<?= base_url('Pedidos') ?>">Registrar Pedido</a>
                    <a class="dropdown-item" href="<?= base_url('PedidosdeMaterial') ?>">Pedidos de Material Varios</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Control</h6>
                    <a class="dropdown-item" href="<?= base_url('Vista_Confirmacion_Usuario') ?>">Confirmar Distribución</a>
                    <a class="dropdown-item" href="<?= base_url('mermas') ?>">Registrar Mermas</a>
                    <a class="dropdown-item" href="<?= base_url('Consultamermas') ?>">Consultar Mermas</a>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown mr-3">
                <a class="nav-link text-white position-relative" href="#" id="campanaNotificaciones" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-lg text-warning"></i>
              <span id="contador-notificaciones" class="badge badge-danger position-absolute" style="top: 0px; right: 0px; font-size: 0.6rem; border-radius: 50%; display: none;">0</span>
                </a>
                
                <div class="dropdown-menu dropdown-menu-right shadow-lg border-0 mt-2" aria-labelledby="campanaNotificaciones" style="background-color: #2a2a2a; min-width: 300px; border-radius: 8px;">
                    <div class="px-3 py-2 border-bottom border-secondary">
                        <h6 class="mb-0 text-warning font-weight-bold">Avisos del Día</h6>
                    </div>
                    
                    <div class="list-group list-group-flush" id="lista-notificaciones" style="max-height: 250px; overflow-y: auto;">
                        <a href="<?= base_url('Produccion_Deseada') ?>" class="list-group-item list-group-item-action text-white" style="background-color: transparent; border-bottom: 1px solid #333;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shopping-basket text-info mr-3"></i>
                                <div>
                                    <p class="mb-0 font-weight-bold" style="font-size: 0.9rem;">Ver Pedidos de Hoy</p>
                                    <small class="text-muted">Revisar panel de producción</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0" id="cerrarsesion_form" action="<?= base_url('/logout') ?>" method="get">
                    <button type="submit" class="btn btn-outline-danger btn-sm shadow" id="cerrarsesion">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<script>
$(document).ready(function() {
    
    function cargarNotificaciones() {
        $.ajax({
            // Asegúrate de que esta ruta existe en tu Routes.php y apunta a tu controlador
            url: '<?= base_url('/obtenerNotificacionesAjax') ?>', 
            type: 'GET',
            dataType: 'json',
            success: function(respuesta) {
                if (respuesta.status === 'success') {
                    
                    let totalAvisos = respuesta.cantidad;
                    let badge = $('#contador-notificaciones'); 
                    let lista = $('#lista-notificaciones');    

                    // 1. Mostrar/Ocultar el globito rojo
                    if (totalAvisos > 0) {
                        badge.text(totalAvisos).show();
                    } else {
                        badge.hide();
                    }

                    // 2. Limpiar la lista actual
                    lista.empty();

                    // 3. Llenar la lista
                    if (totalAvisos > 0) {
                        $.each(respuesta.pedidos, function(nombreProducto, cantidad) {
                            let itemHtml = `
                                <a href="<?= base_url('/Produccion_Deseada') ?>" class="list-group-item list-group-item-action text-white" style="background-color: transparent; border-bottom: 1px solid #333;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-bread-slice text-info mr-3"></i>
                                        <div>
                                            <p class="mb-0 font-weight-bold" style="font-size: 0.9rem;">Pedido: ${nombreProducto}</p>
                                            <small class="text-muted">Cantidad: <span class="badge badge-success">${cantidad} pzs</span></small>
                                        </div>
                                    </div>
                                </a>
                            `;
                            lista.append(itemHtml);
                        });
                    } else {
                        lista.append(`
                            <div class="p-4 text-center text-muted">
                                <i class="fas fa-check-circle mb-2 fa-2x"></i>
                                <p class="mb-0 small">Todo al día.<br>No hay pedidos especiales hoy.</p>
                            </div>
                        `);
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar notificaciones. Verifica tu ruta en el controlador.");
            }
        });
    }

    // Cargar al iniciar la página
    cargarNotificaciones();

    // Actualizar cada 5 minutos (300,000 ms) sin recargar la página
    setInterval(cargarNotificaciones, 300000);

    // Evitar que el dropdown se cierre si haces clic adentro de la lista
    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });
});
</script>