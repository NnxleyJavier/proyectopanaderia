<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidosModel extends Model
{

    protected $table            = 'pedidos';
    protected $primaryKey       = 'idPedidos';
 
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;


    protected $allowedFields    = ['Nombre_Cliente','Fecha_Pedido','Cantidad_requerida','Productos_idProductos','NumeroTelefono','sucursal_recoleccion'];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function BuscarPedidoshoy($fecha)
    {

        $resultado = $this->select('Nombre_Cliente,Fecha_Pedido,Cantidad_requerida,Nombre_Producto')
        ->join('productos', 'productos.idProductos = pedidos.Productos_idProductos','left')
        ->where('Fecha_Pedido', $fecha)
        ->findAll();
    
        if ($resultado) {
    
        return $resultado;
    
        }
         else {
           
             
            return false; // Retorna false si no hay pedidos
        }
      
    }
    public function ObtenerPedidosPanesHoy($fecha)
    {
        // Seleccionamos los datos incluyendo el teléfono y la sucursal de recolección
        $resultado = $this->select('pedidos.Nombre_Cliente, pedidos.Cantidad_requerida, pedidos.NumeroTelefono, pedidos.Fecha_Pedido, productos.Nombre_Producto, sucursales.NombreSucursal as SucursalRecoleccion')
            ->join('productos', 'productos.idProductos = pedidos.Productos_idProductos', 'left')
            ->join('sucursales', 'sucursales.idSucursales = pedidos.sucursal_recoleccion', 'left')
            ->where('pedidos.Fecha_Pedido', $fecha)
            ->findAll();
    
        if ($resultado) {
            return $resultado;
        } else {
            return false; 
        }
    }


}
    