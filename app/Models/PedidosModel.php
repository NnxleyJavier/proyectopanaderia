<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidosModel extends Model
{

    protected $table            = 'pedidos';
    protected $primaryKey       = 'idPedidos';
 
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;


    protected $allowedFields    = ['Nombre_Cliente','Fecha_Pedido','Cantidad_requerida','Productos_idProductos'];

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


}
    