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



}
