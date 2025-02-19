<?php

namespace App\Models;

use CodeIgniter\Model;

class TablaProduccionFechaHasProductos extends Model
{

    protected $table            = 'tabla_produccion_fecha_has_produccion_productos';
    protected $primaryKey       = 'id';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['Tabla_Produccion_idTabla_Produccion_Fecha', 'Produccion_Productos_idProduccion_Productos'];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


public function insertar($FechaIdExiste,$idInsertado){
    $sql = "INSERT INTO `tabla_produccion_fecha_has_produccion_productos` 
    (`id`, `Tabla_Produccion_idTabla_Produccion_Fecha`, `Produccion_Productos_idProduccion_Productos`)
     VALUES (NULL, '$FechaIdExiste', '$idInsertado')";

    $this->query($sql);
}

public function ConsultarPorduccionRegistrada($fecha){
    // Validar que $fecha no sea nula o inválida
    if (empty($fecha)) {
        echo "No existe la fecha";
     }
 
     // Realizar la consulta
     $resultados = $this
         ->select('id,Cantidad_Realizada,Nombre_Producto')
         ->join('produccion_productos', 'produccion_productos.idProduccion_Productos = tabla_produccion_fecha_has_produccion_productos.Produccion_Productos_idProduccion_Productos', 'INNER')
         ->join('productos', 'productos.idProductos = produccion_productos.Productos_idProductos', 'INNER')
         ->where('Tabla_Produccion_idTabla_Produccion_Fecha', $fecha)
         ->findAll();
 
     // Devolver un arreglo vacío si no hay resultados
     return !empty($resultados) ? $resultados : [];

}


public function ConsultarPorduccionRegistradaPorID($ID){
    // Validar que $fecha no sea nula o inválida
    if (empty($ID)) {
        echo "No existe EL ID";
     }
 
     // Realizar la consulta
     $resultados = $this
         ->select('*')
         ->join('produccion_productos', 'produccion_productos.idProduccion_Productos = tabla_produccion_fecha_has_produccion_productos.Produccion_Productos_idProduccion_Productos', 'INNER')
         ->where('id', $ID)
         ->first();
 
     // Devolver un arreglo vacío si no hay resultados
     return !empty($resultados) ? $resultados : [];

}



}
