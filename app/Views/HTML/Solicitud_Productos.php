
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Utilerías</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: radial-gradient(black, transparent);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
          
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            color: black;
            font-size: 2em;
        }
        label {
            color: black;
        }
        p {
            margin: auto;
            color: black;
            font-size: 1em;
            text-align: center;
        }

    </style>
</head>
<body>

<div class="form-container">
    <p><?php echo $fecha; ?></p>
    <h1>Registro de Utilerías</h1>
   <form role="form" class="Formulario_Utileria" id="Formulario_Utileria" name="Formulario_Utileria" method="POST">
   
        <div class="form-group">
            <label for="Cantidad_Pedido">Cantidad Pedido:</label>
            <input type="number" class="form-control" id="Cantidad_Pedido" name="Cantidad_Pedido" required>
        </div>
    
        <div class="form-group">
            <label for="almacen_idAlmacen">Productos del Almacén:</label>
            <select class="form-control" id="almacen_idAlmacen" name="almacen_idAlmacen" required>
            <option value="sin_dato" selected>Nombre Producto de Almacen</option>
                <?php foreach ($Almacen as $row) { ?>
                    <option value="<?php echo $row['idAlmacen']; ?>"><?php echo $row['Nombre_Materia']; ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="hidden" name="users_id" value="<?php echo $user_id; ?>">
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
</body>
</html> 