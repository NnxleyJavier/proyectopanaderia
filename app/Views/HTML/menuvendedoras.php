<nav class="navbar navbar-expand-lg navbar-dark bg-transparent border-bottom border-secondary shadow-sm">
    <a class="navbar-brand font-weight-bold" href="<?= base_url('/') ?>">
        <i class="fas fa-bread-slice text-warning"></i> Aurorita
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/') ?>">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPedidos" role="button" data-toggle="dropdown">
                    <i class="fas fa-shopping-basket"></i> Realizar Pedidos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownPedidos">
                    <a class="dropdown-item" href="<?= base_url('/Pedidos') ?>">
                        <i class="fas fa-utensils me-2 text-muted"></i> Pedido de Pan
                    </a>
                    <a class="dropdown-item" href="<?= base_url('/PedidosdeMaterial') ?>">
                        <i class="fas fa-box-open me-2 text-muted"></i> Pedido de Material
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownControl" role="button" data-toggle="dropdown">
                    <i class="fas fa-clipboard-check"></i> Control
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownControl">
                    <a class="dropdown-item" href="<?= base_url('/Vista_Confirmacion_Usuario') ?>">
                        <i class="fas fa-check-circle me-2 text-muted"></i> Confirmar Distribución
                    </a>
                    <a class="dropdown-item" href="<?= base_url('/mermas') ?>">
                        <i class="fas fa-trash-alt me-2 text-muted"></i> Registrar Mermas
                    </a>
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