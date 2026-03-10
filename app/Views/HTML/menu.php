<nav class="navbar navbar-expand-lg navbar-dark bg-transparent border-bottom border-secondary">
    <a class="navbar-brand" href="/index.php">
        <i class="fas fa-bread-slice"></i> Aurorita
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/index.php"><i class="fas fa-home"></i> Home</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdmin" role="button" data-toggle="dropdown">
                    <i class="fas fa-user-shield"></i> Administración
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
                    <h6 class="dropdown-header">Almacén</h6>
                    <a class="dropdown-item" href="/paginaprincipal">Registro Almacén</a>
                    <a class="dropdown-item" href="/Corroborar">Corroborar Almacén</a>
                    <a class="dropdown-item" href="/producto">Registro de Productos</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Gestión</h6>
                    <a class="dropdown-item" href="/Uso_Materia_Prima">Uso de Materia Prima</a>
                    <a class="dropdown-item" href="/Produccion_Deseada_admin">Actualizar Prod. Deseada</a>
                    <a class="dropdown-item" href="/PedidosdeMaterialConfirmacion">Envío de Utilería</a>
                      <a class="dropdown-item" href="/VistaReportes">Consultar Reporte Ventas.</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProd" role="button" data-toggle="dropdown">
                    <i class="fas fa-industry"></i> Producción
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownProd">
                    <h6 class="dropdown-header">Producción</h6>
                    <a class="dropdown-item" href="/Produccion_Deseada">Ver Producción Deseada</a>
                    <a class="dropdown-item" href="/Vista_Produccion_Real">Registro Producción Real</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Logística / Conteo</h6>
                    <a class="dropdown-item" href="/Vista_Produccion_Registrado">Registro de Distribución</a>
                    
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Reportes</h6>
                    <a class="dropdown-item" href="/GenerarReporteProduccion">Generar Reporte Prod.</a>
                  
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownVentas" role="button" data-toggle="dropdown">
                    <i class="fas fa-cash-register"></i> Ventas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownVentas">
                    <h6 class="dropdown-header">Pedidos</h6>
                    <a class="dropdown-item" href="/Pedidos">Registrar Pedido</a>
                    <a class="dropdown-item" href="/PedidosdeMaterial">Pedidos de Material Varios</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Control</h6>
                    <a class="dropdown-item" href="/Vista_Confirmacion_Usuario">Confirmar Distribución</a>
                    <a class="dropdown-item" href="/mermas">Registrar Mermas</a>
                    <a class="dropdown-item" href="/Consultamermas">Consultar Mermas</a>
                </div>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-0" id="cerrarsesion_form" action="<?= base_url('index.php/logout') ?>" method="get">
            <button type="submit" class="btn btn-outline-danger btn-sm shadow" id="cerrarsesion">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </form>
    </div>
</nav>