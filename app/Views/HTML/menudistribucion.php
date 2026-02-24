<nav class="navbar navbar-expand-lg navbar-dark bg-transparent border-bottom border-secondary shadow-sm">
    <a class="navbar-brand font-weight-bold" href="<?= base_url('/index.php') ?>">
        <i class="fas fa-bread-slice text-warning"></i> Aurorita
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/index.php') ?>">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/Vista_Produccion_Registrado') ?>">
                                <i class="fas fa-truck-loading"></i> Registro de Distribución
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/Consultamermas') ?>">
                                <i class="fas fa-chart-pie"></i> Consulta Mermas
                            </a>
                        </li>

        </ul>

        <form class="form-inline my-2 my-lg-0" id="cerrarsesion_form" action="<?= base_url('index.php/logout') ?>" method="get">
            <button type="submit" class="btn btn-outline-danger btn-sm shadow" id="cerrarsesion">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </form>

        
    </div>
</nav>