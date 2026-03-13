<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Reporte de Pago</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            background-attachment: fixed; /* Evita que el fondo se corte si hay muchos días */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar-custom {
            width: 100%;
            z-index: 1000;
        }
        
        /* Contenedor principal más ancho para acomodar bien la lista de pagos */
        .main-container {
            width: 100%;
            max-width: 700px;
            margin: 40px auto; 
            padding: 20px;
        }
        
        .header {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }
        
        .header h1 {
            font-size: 2.2em;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .form-container {
            background-color: #f8f9fa;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        }
        
        .form-container h3 {
            color: #1e3c72;
            margin-bottom: 30px;
            font-size: 1.6em;
            text-align: center;
            font-weight: 800;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 15px;
        }

        /* Estilos para la lista de días */
        .dia-pago-card {
            background: #fff;
            border-left: 5px solid #2a5298;
            border-radius: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .dia-pago-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1) !important;
        }

        .icon-box {
            background-color: #e9ecef;
            color: #1e3c72;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2em;
        }

        .gran-total-box {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        @media (max-width: 600px) {
            .header h1 { font-size: 1.8em; }
            .form-container { padding: 25px 15px; }
            .dia-pago-card { flex-direction: column; text-align: center; }
            .dia-pago-card .d-flex { flex-direction: column; }
            .icon-box { margin: 0 auto 10px auto !important; }
            .text-md-right { text-align: center !important; margin-top: 15px; }
        }
    </style>
</head>
<body>

    <div class="main-container">
        
        <div class="header">
            <div class="mb-3">
                <i class="fas fa-user-circle fa-4x text-light"></i>
            </div>
            <h1>Bienvenido, <?php echo ($DataNombre); ?></h1>
            <p class="lead text-light opacity-75">Aquí tienes el detalle de tu producción</p>
        </div>
        
        <div class="form-container">
            <h3>
                <i class="fas fa-wallet mr-2 text-primary"></i> Tu Resumen de Pagos
            </h3>
            
            <?php if (!empty($PagoPanadero)): ?>
                
                <?php $granTotal = 0; // Variable para sumar todo ?>
                
                <div class="list-group mb-4">
                    <?php foreach ($PagoPanadero as $diaPago): ?>
                        <?php $granTotal += $diaPago['total']; // Vamos sumando el total de cada día ?>
                        
                        <div class="list-group-item d-flex justify-content-between align-items-center flex-column flex-md-row p-3 mb-3 shadow-sm dia-pago-card border-top-0 border-right-0 border-bottom-0">
                            
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <div class="icon-box rounded-circle mr-3 shadow-sm">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 font-weight-bold text-dark text-capitalize"><?= $diaPago['dia'] ?></h5>
                                    <small class="text-muted"><i class="far fa-calendar-alt mr-1"></i> <?= date('d/m/Y', strtotime($diaPago['fecha'])) ?></small>
                                </div>
                            </div>
                            
                            <div class="text-md-right text-center">
                                <span class="badge badge-primary px-3 py-2 shadow-sm" style="font-size: 1.2em; border-radius: 8px;">
                                    <i class="fas fa-dollar-sign mr-1"></i> <?= number_format($diaPago['total'], 2) ?>
                                </span>
                            </div>
                            
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="gran-total-box d-flex justify-content-between align-items-center mt-4 flex-column flex-md-row text-center text-md-left">
                    <h4 class="mb-2 mb-md-0 font-weight-bold"><i class="fas fa-money-check-alt mr-2"></i>Total Acumulado:</h4>
                    <h2 class="mb-0 font-weight-bold">$<?= number_format($granTotal, 2) ?></h2>
                </div>

            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Aún no hay registros de producción para mostrarte.</h5>
                </div>
            <?php endif; ?>
        
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../JS/index.js"></script>

</body>
</html>