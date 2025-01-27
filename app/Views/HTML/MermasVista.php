<body>
    <br><br>
    <header class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 10vh;">
        <h1>Gestión de Mermas</h1>
    </header>
        
    <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 10vh;">
	<div class="row">
    <main>
    <style>
            main {
             margin: auto;
            }

            form {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            .Enviar{
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin-top:10% ;
                border: none;
                cursor: pointer;
                width: 100%;
            }
            label {
                margin-top: 10px;
            }
            input {
                margin-top: 5px;
            }
        </style>
        <section>


            <h2>Registrar Merma</h2>
            <form role="form" class="Formulario_Mermas" id="Formulario_Mermas" name="Formulario_Mermas" method="POST">
                <label for="Conteo_Merma">Conteo Merma:</label>
                <input type="number" id="Conteo_Merma" name="Conteo_Merma" required>
                
                <label for="Productos_idProductos">ID Producto:</label>
                <select  class="form-control" name="Nombre_Producto" id="Nombre_Producto" required="">
					<option value="sin_dato" selected>Nombre de Producto</option>
					<?php
					foreach ( $Productos as $row )
					{?>
						<option value="<?php echo $row ['idProductos'];?>"><?php echo $row ['Nombre_Producto'];?> </option>
						<?php
					}

					?>
				</select>
                <br>
                <div class="clearfix"></div>
                <button type="submit" class="btn btn btn- btn-lg btn-success" id="MandarRegistroMermas"> <span class="glyphicon glyphicon-floppy-saved"></span> Registrar Mermas ó Sobrantes</button>
            </form>

    </main>
    </div>
    </div>
    <footer>
    
        <p>&copy; 2023 Panadería</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
</body>
