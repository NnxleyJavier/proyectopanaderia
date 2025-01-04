
<link rel="stylesheet" href="css/Notificacion.css">

<body>
    <div class="contenedor">
        <div class="barra-superior">
            <img src="Recursos/campana.png" alt="Icono de campana">
            <h1>Notificación</h1>
        </div>
        <div class="contenedor-central">
            <div class="notificacion">
                <div class="icono-calendario">
                    <img src="Recursos/calendario.png" alt="Icono de calendario">
                </div>
                <div class="texto-notificacion">
                    <p><strong> Mas Actual </strong></p>
                </div>
            </div>
            
            <div class="notificacion">
                <div class="icono-mensaje">
                   
                </div>
                <div class="texto-notificacion">
                    
                    <?php
                   
					foreach ( $datos as $row )
					{?>
                        <p>FECHA : <strong><?php echo $row['Fecha_Registro'] ?></strong></p>
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