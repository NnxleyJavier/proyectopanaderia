<?php

namespace App\Models;

use CodeIgniter\Model;

class SalidaMercancia extends Model
{

    protected $table            = 'salida_mercancia';
    protected $primaryKey       = 'idSalida_Mercancia';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['Cantidad_Salida','Productos_idProductos','Tabla_Produccion_Fecha_idTabla_Produccion','Sucursales_idSucursales'];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

public function Buscartotales($fecha){

    return $this->select('Nombre_Producto,Cantidad_Salida')
		->join('productos', 'productos.idProductos = salida_mercancia.Productos_idProductos','INNER')
        -> where('Tabla_Produccion_Fecha_idTabla_Produccion', $fecha)
		->findAll();
    
}

}
