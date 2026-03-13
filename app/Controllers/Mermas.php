<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Productos;
use App\Models\TablaProduccionFecha;
use App\Models\MermasModel;
use CodeIgniter\Shield\Models\UserModel;
use App\Models\Empleados;
use App\Models\TablaSucursales;

class Mermas extends BaseController
{
    public function index()
    {
		// 1. Obtener Productos
        $datos_Productos = new Productos();
        $select_Productos = $datos_Productos->Buscar_productos();
		
		// 2. Obtener el ID del Usuario logueado	
        $controlerHome = new Home();
	    $IdUsuario = $controlerHome->ObtenerId_User();


		// 3. Buscar la Sucursal del Usuario usando el Modelo (Código limpio)
        $modeloSucursales = new TablaSucursales();
        $sucursalDelUsuario = $modeloSucursales->ObtenerSucursalPorUsuario($IdUsuario);

		$ArregloFechaSiExiste = $this->ObtenerFecha($this->fecha());

		echo "   ".$ArregloFechaSiExiste['idTabla_Produccion'];

		// 4. Preparamos los datos para la Vista
        $dataVista = [
            'Productos'      => $select_Productos,
            'idSucursal'     => $sucursalDelUsuario ? $sucursalDelUsuario['idSucursales'] : '',
            'nombreSucursal' => $sucursalDelUsuario ? $sucursalDelUsuario['NombreSucursal'] : 'Sin Asignar'
        ];

        $vistaMermas =
            view('html/Cabecera') .
            view('html/menuvendedoras') .
            view('html/MermasVista', $dataVista);
        return $vistaMermas;
    }



    
    public function AgregarMermas()
    {
        $modeloMermas = new MermasModel();
        $Formulario_Pedidos = $this->validarmermas();

        var_dump($Formulario_Pedidos);
        $modeloMermas->insert($Formulario_Pedidos);

	//  d($this->ObtenerFecha($this->fecha()));
    }


// aqui ademas de validar los datos de los formularios, se obtiene el id del usuario que esta realizando la peticion y 
//tambien se obtiene el id de la fecha de la tabla produccion
    private function validarmermas()
	{   

		$ArregloFechaSiExiste = $this->ObtenerFecha($this->fecha());
		
        $controlerHome = new Home();
        $IdUsuario=$controlerHome->ObtenerId_User();
     

        
		if ($this->request->getPost()) {
			$Conteo_Merma = trim($this->request->getPost("Conteo_Merma"));
			$productos_idProductos = trim($this->request->getPost("Nombre_Producto"));
			// Atrapamos la sucursal desde el formulario
			$sucursal_id = trim($this->request->getPost("Sucursales_idSucursales"));
		
		}
		if (
			isset($Conteo_Merma) && !empty($Conteo_Merma) &&
            isset($productos_idProductos) && !empty($productos_idProductos) && $productos_idProductos !== "sin_dato" &&
            isset($sucursal_id) && !empty($sucursal_id) && // <--- Validamos que llegue la sucursal
            isset($IdUsuario) && !empty($IdUsuario) &&
            isset($ArregloFechaSiExiste['idTabla_Produccion']) && !empty($ArregloFechaSiExiste['idTabla_Produccion'])
		) {
			$validarformpedidos = array(
                "Conteo_Merma" => $Conteo_Merma,
                "productos_idProductos" => $productos_idProductos,
                "users_id" => $IdUsuario,
                "tabla_produccion_fecha_idTabla_Produccion" => $ArregloFechaSiExiste['idTabla_Produccion'],
                "Sucursales_idSucursales" => $sucursal_id // <--- Lo pasamos al arreglo para guardar
            );
			
				return $validarformpedidos;
        } else {
            echo "❌ Error: Faltan datos para registrar la merma.";
            return false;
        }
	}

	private function ObtenerFecha($fecha)
	{
		$modeloTablaProduccionFecha = new TablaProduccionFecha();

		return $modeloTablaProduccionFecha->obtenerFecha($fecha);
	}


	private function fecha()
	{
		date_default_timezone_set('America/Mexico_City'); // O la zona horaria que necesites
		$fecha = date("Y-m-d");
		return $fecha;
	}
	
}
