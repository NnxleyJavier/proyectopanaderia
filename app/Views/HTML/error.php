<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado - Aurorita</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        body {
            background-color: #121212; /* Fondo muy oscuro */
            color: #e0e0e0;
            height: 100vh; /* Altura completa de la ventana */
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }

        .error-card {
            text-align: center;
            max-width: 500px;
            padding: 40px;
            border-radius: 15px;
            background: #1e1e1e; /* Un tono ligeramente más claro que el fondo */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s ease-in-out;
            border: 1px solid #333;
        }

        .icon-container {
            margin-bottom: 20px;
        }

        .error-code {
            font-size: 5rem;
            font-weight: 700;
            line-height: 1;
            background: -webkit-linear-gradient(#ff6b6b, #c92a2a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .btn-home {
            background-color: #007bff;
            border: none;
            padding: 10px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .btn-home:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        }

        /* Animación de entrada */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="error-card">
                    
                    <div class="icon-container">
                        <i class="fas fa-user-lock fa-4x text-danger"></i>
                    </div>

                    <h1 class="error-code">401</h1>
                    <h3 class="font-weight-bold mb-3">Acceso No Autorizado</h3>
                    
                    <p class="text-muted mb-4">
                        Lo sentimos, no tienes los permisos necesarios para ver este recurso. 
                        Asegúrate de haber iniciado sesión con la cuenta correcta.
                    </p>

                    <a href="<?= base_url('/') ?>" class="btn btn-home btn-primary text-white shadow">
                        <i class="fas fa-home mr-2"></i> Volver al Inicio
                    </a>

                    <div class="mt-4 text-small text-secondary" style="font-size: 0.85rem;">
                        <i class="fas fa-spinner fa-spin mr-1"></i>
                        Redirigiendo automáticamente en <span id="countdown" class="font-weight-bold text-white">5</span> segundos...
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Configura aquí la URL a la que quieres redirigir
        // Usamos PHP para imprimir la ruta base si es un archivo .php, 
        // si es HTML puro cambia esto por '/' o 'index.html'
        const targetUrl = "<?= base_url('/') ?>"; 
        
        let seconds = 5; // Segundos a esperar
        const countdownElement = document.getElementById('countdown');

        const interval = setInterval(() => {
            seconds--;
            countdownElement.textContent = seconds;

            if (seconds <= 0) {
                clearInterval(interval);
                window.location.href = targetUrl;
            }
        }, 1000);
    </script>

</body>
</html>