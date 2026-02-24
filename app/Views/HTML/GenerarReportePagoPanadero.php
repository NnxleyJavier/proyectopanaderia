<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago a Panaderos</title>
    
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
            min-height: 100vh;
            display: flex;
            flex-direction: column; /* CAMBIO: Para que el menú quede arriba y el resto abajo */
            align-items: center;
            /* El padding lo manejo abajo para separar del menú */
        }

        /* Ajuste para el menú transparente sobre fondo azul */
        .navbar-custom {
            width: 100%;
            z-index: 1000;
        }
        
        /* Contenedor principal centrado con margen automático */
        .main-container {
            width: 100%;
            max-width: 500px;
            margin: auto; /* Esto centra verticalmente el formulario en el espacio restante */
            padding: 20px;
        }
        
        .header {
            text-align: center;
            color: #fff;
            margin-bottom: 40px;
        }
        
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .form-container {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }
        
        .form-container h3 {
            color: #1e3c72;
            margin-bottom: 30px;
            font-size: 1.5em;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            color: #1e3c72;
            font-weight: 600;
            font-size: 1em;
        }
        
        select.form-control {
            width: 100%;
            padding: 10px 15px; /* Ajusté un poco el padding para que se vea mejor */
            border: 2px solid #2a5298;
            border-radius: 8px;
            font-size: 1em;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%231e3c72' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 18px;
            height: auto !important; /* Forza altura automática para evitar conflictos con Bootstrap */
        }
        
        select.form-control:hover {
            border-color: #1e3c72;
        }
        
        select.form-control:focus {
            outline: none;
            border-color: #1e3c72;
            box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
        }
        
        .btn-submit {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(30, 60, 114, 0.3);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit i {
            margin-right: 10px;
        }
        
        @media (max-width: 600px) {
            .header h1 { font-size: 1.8em; }
            .form-container { padding: 25px 20px; }
            .form-container h3 { font-size: 1.3em; }
            label { font-size: 0.95em; }
        }
    </style>
</head>
<body>
    

    <div class="main-container">
        
        <div class="header">
            <div class="mb-3">
                <i class="fas fa-user-circle fa-3x"></i>
            </div>
            <h1>Bienvenido a <?php echo ($DataNombre); ?></h1>
        </div>
        
        <div class="form-container">
            <h3>
                <i class="fas fa-money-bill-wave mr-2"></i> Escoge a tu panadero
            </h3>
            
            <form role="form" id="Formulario_Paga" name="Formulario_Paga" method="POST">
                
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                
                <div class="form-group">
                    <label for="Panadero">
                        <i class="fas fa-user-tie mr-2"></i> Panadero Disponible
                    </label>
                    <select class="form-control" name="Panadero" id="Panadero" required="">
                        <option value="sin_dato" selected>Selecciona un Panadero</option>
                        <?php foreach ($Panaderos as $panadero) { ?>
                            <option value="<?php echo $panadero['id']; ?>">
                                <?php echo $panadero['username']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                
                <button type="submit" class="btn-submit" id="registrar_pago_panadero">
                    <i class="fas fa-check-circle"></i> Escoger Panadero
                </button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../JS/index.js"></script>

</body>
</html>