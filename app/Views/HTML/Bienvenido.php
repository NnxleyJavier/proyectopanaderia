<style>
        /* Estilos específicos para el contenido central */
        .full-height {
            min-height: 80vh; /* Altura visual menos el menú */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1); /* Blanco semitransparente */
            backdrop-filter: blur(10px); /* Efecto borroso detrás */
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            text-align: center;
            max-width: 600px;
            width: 90%;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            color: #fff;
            margin-bottom: 20px;
        }
        
        .welcome-text {
            font-size: 1.2rem;
            color: #ddd !important;
        }
    </style>

    <div class="modal fade" id="modalPedidosInicio" tabindex="-1" role="dialog" aria-labelledby="modalLabelPedidos" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-white" style="background-color: #2a2a2a; box-shadow: 0 0 20px rgb(236, 232, 2);">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title font-weight-bold" id="modalLabelPedidos">
                        <i class="fas fa-shopping-basket mr-2"></i> ¡Tienes Pedidos De Pan !
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-white">
                    <p class="text-info font-weight-bold">Los siguientes pedidos están pendientes para hoy:</p>
                    
                    <ul class="list-group list-group-flush" id="lista-pedidos-modal" style="max-height: 250px; overflow-y: auto;">
                        </ul>

                </div>
                <div class="modal-footer" style="border-top: 1px solid #444;">
                    <a href="<?= base_url('/Produccion_Deseada') ?>" class="btn btn-outline-info">Ver panel de Producción</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container full-height">
        <div class="glass-card fade-in">
            <h1 class="welcome-title">¡Hola!</h1>
            <h2 class="welcome-text">Bienvenido al sistema</h2>
            
            <div class="mt-4 p-3" style="background: rgba(0,0,0,0.3); border-radius: 10px;">
                <h3 class="m-0 text-warning"><?php echo isset($DataNombre) ? $DataNombre : 'Usuario'; ?></h3>
            </div>

            <div class="mt-5">
                <p class="small text-white-50">Sistema de Gestión - Panadería Aurorita</p>
                <a href="/paginaprincipal" class="btn btn-outline-light btn-sm">Ir al Panel Principal</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../public/JS/index.js"></script>
    
    <script>
        $(document).ready(function(){
            // 1. Animación de tu tarjeta de cristal de bienvenida
            $(".glass-card").hide().fadeIn(100);

            // 2. Consulta AJAX para rellenar y mostrar el modal de pedidos
            $.ajax({
                url: '<?= base_url('/obtenerNotificacionesAjax') ?>', // Llamamos a tu función de la campana
                type: 'GET',
                dataType: 'json',
                success: function(respuesta) {
                    
                    // Verificamos si la respuesta es exitosa y si hay más de 0 pedidos
                    if (respuesta.status === 'success' && respuesta.cantidad > 0) {
                        
                        let listaModal = $('#lista-pedidos-modal');
                        listaModal.empty(); // Limpiamos por precaución
                        
                        // Recorremos los pedidos recibidos
                        $.each(respuesta.pedidos, function(nombreProducto, cantidad) {
                            // Construimos la fila HTML de cada pedido
                            let itemHtml = `
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #1a1a1a; border-color: #444;">
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bold text-white">
                                            <i class="fas fa-bread-slice text-secondary mr-2" style="font-size: 0.8rem;"></i>
                                            ${nombreProducto}
                                        </span>
                                    </div>
                                    <span class="badge badge-info badge-pill shadow-sm" style="font-size: 0.9rem;">
                                        ${cantidad} pzs
                                    </span>
                                </li>
                            `;
                            // La inyectamos en el modal
                            listaModal.append(itemHtml);
                        });

                        // Le damos un pequeño retraso visual para que la alerta salte de forma fluida 
                        // después de que la tarjeta de cristal haya aparecido
                        setTimeout(function() {
                            $('#modalPedidosInicio').modal('show');
                        }, 100);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error cargando pedidos para el inicio: ", error);
                }
            });
        });
    </script>
</body>
</html>