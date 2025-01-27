<body>

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
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
         <!--  <section>
            <h2>Lista de Pedidos</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                     Aquí se llenarán los pedidos dinámicamente
                    <?php /* foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= $pedido['id'] ?></td>
                        <td><?= $pedido['cliente'] ?></td>
                        <td><?= $pedido['producto'] ?></td>
                        <td><?= $pedido['cantidad'] ?></td>
                        <td><?= $pedido['fecha'] ?></td>
                        <td>
                            <a href="/editar-pedido/<?= $pedido['id'] ?>">Editar</a>
                            <a href="/eliminar-pedido/<?= $pedido['id'] ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; */ ?>
                </tbody>

            </table>
        </section>-->
         
        <section>
   
        <h1>Gestión de Pedidos</h1>
    
        <h2>Agregar Nuevo Pedido</h2>
        <form role="form" class="Formulario_Pedidos" id="Formulario_Pedidos" name="Formulario_Pedidos" method="POST">
                <label for="cliente">Nombre del Cliente:</label>
                <input type="text" id="cliente" name="cliente" placeholder="Agregar Nombre">
                
                <label for="producto">Producto:</label>
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
                
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" placeholder="Agregar Cantidad" required>
                
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
                
                    <br>
                <button type="submit" class="btn btn btn- btn-lg btn-success" id="MandarPedido"> <span class="glyphicon glyphicon-floppy-saved"></span> Agregar Pedido</button>
            </form>
        </section>
    </main>
 
    <footer>
        
        <p>&copy; 2025 Panadería</p>
    </footer>

	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
</body>
