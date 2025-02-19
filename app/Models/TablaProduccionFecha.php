<?php

namespace App\Models;

use CodeIgniter\Model;

class TablaProduccionFecha extends Model
{

    protected $table            = 'tabla_produccion_fecha';
    protected $primaryKey       = 'idTabla_Produccion';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['Fecha_de_Produccion'];

    // Dates
    protected $useTimestamps = false;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


public function UltimaFecha($FechaSistem){

    $resultado = $this->select('idTabla_Produccion')
    ->where('Fecha_de_Produccion', $FechaSistem)
    ->first();

    if ($resultado) {


    return $resultado["idTabla_Produccion"];

    }
    else {
       $this->insert(['Fecha_de_Produccion' => $FechaSistem]);

       $ultimoID = (int) $this->getInsertID(); // Obtiene el último ID de inserción y lo convierte a int
       
       return $ultimoID; // Retorna el ID
    }
} 


public function ConsultarPorduccionRegistrada($fecha){
    return $this->select('Cantidad_Realizada,Nombre_Producto,Fecha_de_Produccion,Categoria')
		->join('tabla_produccion_fecha_has_produccion_productos', 'tabla_produccion_fecha_has_produccion_productos.Tabla_Produccion_idTabla_Produccion_Fecha = tabla_produccion_fecha.idTabla_Produccion','INNER')
		->join('produccion_productos', 'produccion_productos.idProduccion_Productos = tabla_produccion_fecha_has_produccion_productos.Produccion_Productos_idProduccion_Productos','INNER')
		->join('productos', 'productos.idProductos = produccion_productos.Productos_idProductos','INNER')
		-> where('Fecha_de_Produccion', $fecha)
		->findAll();
}

public function obtenerFecha($FechaSistem)  {
    
    $resultado = $this->select('idTabla_Produccion')
    ->where('Fecha_de_Produccion', $FechaSistem)
    ->first();

    if ($resultado) {

    return $resultado;

    }else{
        return false;
    }
}

}
