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

  // Validar que $fecha no sea nula o inválida
    if (empty($fecha)) {
       echo "No existe la fecha";
    }

    // Realizar la consulta
    $resultados = $this
        ->select('productos.Nombre_Producto, salida_mercancia.Cantidad_Salida , Sucursales_idSucursales')
        ->join('productos', 'productos.idProductos = salida_mercancia.Productos_idProductos', 'INNER')
        ->where('Tabla_Produccion_Fecha_idTabla_Produccion', $fecha)
        ->findAll();

    // Devolver un arreglo vacío si no hay resultados
    return !empty($resultados) ? $resultados : [];
}

public function Buscartotalesconsucursal($fecha,$Sucursal){

    // Validar que $fecha no sea nula o inválida
      if (empty($fecha)) {
         echo "No existe la fecha No se ha generado Produccion en el dia de hoy";
      }
  
      // Realizar la consulta
      $resultados = $this
          ->select('idSalida_Mercancia,productos.Nombre_Producto, salida_mercancia.Cantidad_Salida , Sucursales_idSucursales')
          ->join('productos', 'productos.idProductos = salida_mercancia.Productos_idProductos', 'INNER')
          ->where('Tabla_Produccion_Fecha_idTabla_Produccion', $fecha)
          ->where('Sucursales_idSucursales', $Sucursal) // Segunda condición
          ->findAll();
  
      // Devolver un arreglo vacío si no hay resultados
      return !empty($resultados) ? $resultados : [];
  }

}
