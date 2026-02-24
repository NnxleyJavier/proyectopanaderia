<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class EnviarNotificacion extends BaseCommand
{

    protected $group       = 'notifications';
    protected $name        = 'notificaciones:enviar';
    protected $description = 'Envía notificaciones diariamente a las 8 AM';
    

    public function run(array $params)
    {
      // Tu lógica para enviar notificaciones
        // Ejemplo: enviar un correo o registrar en la base de datos
        $mensaje = "Este es un recordatorio diario enviado a las 8 AM.";
        
        // Simulación de envío (puedes usar un servicio de correo aquí)
        CLI::write("Notificación enviada: {$mensaje}", 'green');
    }
}
