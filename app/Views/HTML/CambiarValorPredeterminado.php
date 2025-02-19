<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de  Cantidades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Adaptable.css">
<body>

<div class="form-container" >
    <div class="container-fluid">
        <div class="row">



            <form role="form" class="Formulario_Valor_Predetermindado" id="Formulario_Valor_Predetermindado" name="Formulario_Valor_Predetermindado" method="POST">
                <h5>Añade los valores predetermiados estos saldran cuando escojas un producto en el area de Distribucion</h5>


                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                <div class="form-group">
                    <label for="Nombre_Producto">Nombre_Producto</label>
                    <select  class="form-control" name="Nombre_Producto" id="Nombre_Producto" required="">
                        <option value="sin_dato" selected>Nombre de Producto</option>
                       <?php
                        foreach ( $Productos as $row )
                        {?>
                            <option value="<?php echo $row?>"><?php echo $row?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>


                <div class="form-group">
                    <label for="Cantidad_Gasto">Valor Predeterminado</label>
                    <input type="number" step="1" class="form-control" placeholder="Valor Predeterminado" id="Predeterminado" name="Predeterminado">
                </div>


                <br><br>
                <div class="clearfix"></div>
                <button type="submit" class="btn btn btn-primary btn-lg btn-responsive" > <span class="glyphicon glyphicon-floppy-saved"></span> Registar</button>
            </form>

        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
</body>