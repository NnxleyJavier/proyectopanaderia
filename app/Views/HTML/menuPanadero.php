<nav class="navbar navbar-expand-lg navbar-dark bg-transparent border-bottom border-secondary">
    <a class="navbar-brand" href="<?= base_url('/index.php') ?>">
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

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProd" role="button" data-toggle="dropdown">
                    <i class="fas fa-industry"></i> Producción
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownProd">
                    <a class="dropdown-item" href="<?= base_url('/Produccion_Deseada') ?>">
                        Ver Producción Deseada
                    </a>
                    <a class="dropdown-item" href="<?= base_url('/Vista_Produccion_Real') ?>">
                        Registro Producción Real
                    </a>
                      <a class="dropdown-item" href="<?= base_url('/VistaReportePanadero') ?>">
                        Reporte de Pagos
                    </a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link text-danger" href="<?= base_url('/Eliminarpanadero') ?>">
                    <i class="fas fa-user-times"></i> Eliminar Producción Panadero
                </a>
            </li>

        </ul>

   <form class="form-inline my-2 my-lg-0" id="cerrarsesion_form" action="<?= base_url('index.php/logout')?>" method="get">
            <button type="submit" class="btn btn-outline-danger btn-sm shadow" id="cerrarsesion">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </form>
    </div>
</nav>