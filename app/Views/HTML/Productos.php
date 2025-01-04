

<body>

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
	<div class="row">



						<form role="form" class="Formulario_Producto" id="Formulario_Producto" name="Formulario_Producto" method="POST">
							<h1>Registro de productos</h1>
							<div class="form-group">
								<label for="Nombre_Producto">Nombre de Producto</label>
								<input type="text"  class="form-control" placeholder="Nombre_Producto" id="Nombre_Producto" name="Nombre_Producto" >
							</div>


							<div class="form-group">
								<label for="Valor_produccion">Valor de produccion $$ </label>
								<input type="number"  class="form-control" placeholder="Valor de produccion" id="Valor_produccion" name="Valor_produccion">
							</div>



							<div class="form-group">
								<label for="Valor_Venta">Valor de Venta</label>
								<input type="number" class="form-control" placeholder="Valor de Venta" id="Valor_Venta" name="Valor_Venta">
							</div>


							<div class="form-group">
								<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
							</div>

							<br><br>
							<div class="clearfix"></div>
							<button type="submit" class="btn btn btn-primary btn-lg btn-responsive" id="registrar_Incremento_Almacen"> <span class="glyphicon glyphicon-floppy-saved"></span> Agregar producto en ventas</button>
						</form>

					</div>
				</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="JS/index.js"></script>
</body>


