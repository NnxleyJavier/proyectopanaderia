
<link rel="stylesheet" href="css/Notificacion.css">

<body>
<h1 class="container-fluid d-flex justify-content-center align-items-center"><?php echo $Fecha ?></h1>
<div class="contenedor">
        <div class="barra-superior">
            <img src="Recursos/campana.png" alt="Icono de campana">
            <h1>Notificación</h1>
        </div>
       
            <div class="notificacion">
                <div class="icono-calendario">
                    <img src="Recursos/calendario.png" alt="Icono de calendario">
                </div>
                <div class="texto-notificacion">
                    <p><strong> Pedidos </strong></p>
                </div>
            </div>
            
            <div class="notificacion">
                <div class="icono-pedido d-flex justify-content-center align-items-center">
                    <img src="Recursos/pedido.png" alt="Icono de pedido" class="img-fluid" style="max-width: 10vh;">
                </div>
                <div class="texto-notificacion">
                    <?php
                    if (empty($ConsultaPedidos)) {
                        echo "<p>Sin pedidos</p>";
                    } else {
                        foreach ($ConsultaPedidos as $nombre => $cantidad) {
                            echo "<p>Producto: <strong>{$nombre}</strong></p>";
                            echo "<p>Cantidad: <strong>{$cantidad}</strong></p>";
                            echo "<br>";
                        }
                    }
                    ?>
                </div>
                </div>
           



            <div class="notificacion">
                <div class="icono-calendario">
                    <img src="Recursos/calendario.png" alt="Icono de calendario">
                </div>
                <div class="texto-notificacion">
                    <p><strong> Produccion Deseada </strong></p>
                </div>
            </div>



            <div class="notificacion">
                <div class="icono-mensaje">
                   
                </div>
                <div class="texto-notificacion">
                    
                    <?php
                   
					foreach ( $datos as $row )
					{?>
                        <p>FECHA DE REGISTRO: <strong><?php echo $row['Fecha_Registro'] ?></strong></p>
                        <p>PRODUCTO : <strong><?php echo $row['Nombre_Producto'] ?></strong></p>
						<p> Cantidad solicitada: <b> <?php echo $row ['Cantidad_requerida'];?></b> </p>
                        <br>
						<?php
					}

                

					?>

                    
                </div>
            </div>


            
            <!-- Puedes agregar más notificaciones aquí según sea necesario -->
            
        </div>
    </div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
</body>