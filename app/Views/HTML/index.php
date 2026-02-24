<div class="container mt-3">
    <form class="form-inline d-flex justify-content-center">
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar producto" aria-label="Buscar" id="searchInput" onkeyup="searchProduct()">
        <button class="btn btn-outline-warning my-2 my-sm-0" type="button" onclick="searchProduct()">Buscar</button>
    </form>
</div>

<script>
// Tu script de búsqueda se mantiene igual
function searchProduct() {
    var input, filter, cards, cardContainer, title, i;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementsByClassName("row")[0];
    cards = cardContainer.getElementsByClassName("col-md-4");
    for (i = 0; i < cards.length; i++) {
        title = cards[i].getElementsByClassName("card-title")[0];
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}
</script>

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">


  <?php
    $listaAgotados = [];
    foreach ($datos as $p) {
        // Convertimos a número para comparar bien
        $stock = floatval($p['Cantidad_Existente'] ?? 0);
        $minimo = floatval($p['Cantidad_Minimas'] ?? 0);
        
        if ($stock < $minimo) {
            $listaAgotados[] = [
                'nombre' => $p['Nombre_Materia'],
                'stock' => $stock,
                // --- AGREGAMOS ESTOS DATOS ---
                // Asegúrate que estos nombres coincidan con las columnas de tu BD
                'proveedor' => $p['Nombre_provedor'] ?? 'Prov. Desconocido', 
                'numero' => $p['Telefono'] ?? 'S/N' // O 'Numero_Producto' según tu BD
            ];
        }
    }
    ?>

 <?php if (count($listaAgotados) > 0): ?>
    <div class="modal fade" id="modalStockBajo" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-danger">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="modalLabel">⚠️ Alerta de Inventario Crítico</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="text-danger">Los siguientes productos están por debajo del mínimo:</p>
            <ul class="list-group list-group-flush">
                <?php foreach($listaAgotados as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center text-dark">
                        <div class="d-flex flex-column">
                            <span class="font-weight-bold">
                                <?php echo $item['nombre']; ?>
                            </span>
                            <small class="text-muted">
                                <strong>Prov:</strong> <?php echo $item['proveedor']; ?> | 
                                <strong>No:</strong> <?php echo $item['numero']; ?>
                            </small>
                        </div>

                        <span class="badge badge-danger badge-pill">
                            Quedan: <?php echo $item['stock']; ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>


    <div class="row col-md-12">
        <?php
        foreach ($datos as $row){
            // Análisis individual para pintar la tarjeta
            $stockActual = floatval($row['Cantidad_Existente'] ?? 0);
            $stockMinimo = floatval($row['Cantidad_Minimas'] ?? 0);
            
            // Variable de estilo para el borde rojo
            $estiloTarjeta = ""; 
            $iconoAlerta = "";

            // Si el stock es bajo, aplicamos el borde rojo y sombra
            if ($stockActual < $stockMinimo) {
                $estiloTarjeta = "border: 2px solid #dc3545; box-shadow: 0 0 15px rgba(220, 53, 69, 0.4);";
                $iconoAlerta = '<span style="color:red; font-weight:bold;">⚠️ </span>';
            }
        ?>

        <div class="col-md-4 mb-4">
            <div class="card" style="<?php echo $estiloTarjeta; ?>">
                
                <img src="<?php try { echo $row['imagen_ref'];} catch (Exception $e) {echo "Undefined ";} if($row['imagen_ref']==Null){}?>" class="card-img-top" alt="...">
                
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $iconoAlerta; ?>
                        <?php try { echo $row['Nombre_Materia'];} catch (Exception $e) {echo "Undefined ";}?>
                    </h5>
                    
                    <p class="card-text">Cantidad en almacén: <B> <?php try { echo $row['Cantidad_Existente'];} catch (Exception $e) {echo "Undefined ";}?></B></p>
                    <p class="card-text">Tipo de Medición: <B> <?php try { echo $row['Medida'];} catch (Exception $e) {echo "Undefined ";}?></B></p>
                    <p class="card-text">Las/Los <?php try { echo $row['Medida'];} catch (Exception $e) {echo "Undefined ";}?> contiene:
                        <B> <?php try { echo $row['Cantidad_medida'];} catch (Exception $e) {echo "Undefined ";}?></B>
                        <B> <?php try { echo $row['Tipo_medicion'];} catch (Exception $e) {echo "Undefined ";}?></B>
                    </p>

                    <button type="submit" class="Llegada btn btn-primary btn-lg btn-responsive" id="Llegada">llegada de producto</button>
                </div>
                
                <div id="Card-footer" style="display: none;" >
                    <p><b>Formulario de Registro de Compra de Mercancia</b></p>
                    <form role="form" class="formulario_registro" id="formulario_registro" name="formulario_registro" method="POST">
                        <div class="form-group">
                            <label for="idAlmacen">idAlmacen</label>
                            <input type="text" value="<?php try { echo $row['idAlmacen'];} catch (Exception $e) {echo "Undefined ";}?>" class="form-control" placeholder="idAlmacen" id="idAlmacen" name="idAlmacen" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Fecha de Ingreso">Fecha de Ingreso</label>
                            <input type="date" class="form-control" placeholder="Fecha de Ingreso" id="Fecha_de_Ingreso" name="Fecha_de_Ingreso">
                        </div>
                        
                          	<div class="form-group">
   				                <label for="Cantidad">Cantidad a Ingresar</label>
    			                <input type="number" class="form-control" placeholder="Cantidad a Ingresar" id="Cantidad_Ingresada" name="Cantidad_Ingresada" step="0.01" min="0">
				            </div>

                        <label for="Cantidad">Tipo de Medicion</label>
                        <select type="text" class="form-control" id="Tipo_Medicion" name="Tipo_Medicion">
                            <option value="<?php try { echo $row['Medida'];} catch (Exception $e) {echo "Undefined ";}?>" selected><?php try { echo $row['Medida'];} catch (Exception $e) {echo "Undefined ";}?> </option>
                            <option value="<?php try { echo $row['Tipo_medicion'];} catch (Exception $e) {echo "Undefined ";}?>"><?php try { echo $row['Tipo_medicion'];} catch (Exception $e) {echo "Undefined ";}?> </option>
                        </select>
                        <div class="form-group">
                            <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        </div>
                        <br><br>
                        <div class="clearfix"></div>
                        <button type="submit" class="btn btn btn-success btn-lg btn-responsive" id="registrar_Incremento_Almacen"> <span class="glyphicon glyphicon-floppy-saved"></span> Registrar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<script>
// Verificar si existe el modal en el DOM (significa que PHP encontró errores)
$(document).ready(function() {
    if ($('#modalStockBajo').length) {
        $('#modalStockBajo').modal('show');
    }
});
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../JS/index.js"></script>
</body>
</html>
