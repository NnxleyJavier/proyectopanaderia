<?php

namespace App\Controllers;
use CodeIgniter\Shield\Models\UserModel;
use App\Models\Productos;
use App\Models\PedidosModel;

class Pedidos extends BaseController
{
    public function index()
    {
        $datos_Productos = new Productos();
        $select_Productos = $datos_Productos->Buscar_productos();


        $vistaProduccionDeseada =
        view('html/Cabecera') .
        view('html/menu') .
        view('html/pedidos',array('Productos' => $select_Productos));

    return $vistaProduccionDeseada;

    }

    public function AgregarPedidos()
    {
        $modeloPedidos = new PedidosModel();
        $Formulario_Pedidos = $this->validarforpedidos();
        $modeloPedidos->insert($Formulario_Pedidos);

        
    }

    private function validarforpedidos()
	{


		if ($this->request->getPost()) {
			$Nombre_Cliente = trim($this->request->getPost("cliente"));
			$Fecha_Pedido = trim($this->request->getPost("fecha"));
			$Cantidad_requerida = trim($this->request->getPost("cantidad"));
			$Productos_idProductos = trim($this->request->getPost("Nombre_Producto"));
		}
		if (
			isset($Nombre_Cliente) && !empty($Nombre_Cliente) &&
			isset($Fecha_Pedido) && !empty($Fecha_Pedido) &&
			isset($Cantidad_requerida) && !empty($Cantidad_requerida) &&
			isset($Productos_idProductos) && !empty($Productos_idProductos)

		) {
			$validarformpedidos = array(
				"Nombre_Cliente" => $Nombre_Cliente,
				"Fecha_Pedido" => $Fecha_Pedido,
				"Cantidad_requerida" => $Cantidad_requerida,
				"Productos_idProductos" => $Productos_idProductos

			);
			
			return $validarformpedidos;
        } else {
			echo "❌ Error: Faltan campos obligatorios.";
			return false;
		}
	}


}