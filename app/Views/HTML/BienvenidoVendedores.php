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
            $(".glass-card").hide().fadeIn(1000);
        });
    </script>
</body>
</html>