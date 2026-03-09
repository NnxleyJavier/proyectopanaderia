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
        ->select('productos.Nombre_Producto, salida_mercancia.Cantidad_Salida , NombreSucursal, productos.Categoria')
        ->join('productos', 'productos.idProductos = salida_mercancia.Productos_idProductos', 'INNER')
        ->join('sucursales', 'sucursales.idSucursales = salida_mercancia.Sucursales_idSucursales', 'INNER')
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



  

  // --- NUEVAS FUNCIONES PARA EL DASHBOARD DE REPORTES ---

public function ReporteDiarioDashboard($idTablaProduccion)
    {
        if (empty($idTablaProduccion)) {
            return [];
        }

        $resultados = $this
            ->select('
                productos.Nombre_Producto, 
                productos.Valor_Venta,
                salida_mercancia.Cantidad_Salida, 
                sucursales.NombreSucursal, 
                mercancia_sucursal.Confirmacion_Salida, 
                mercancia_sucursal.Nota,
                (
                    SELECT SUM(Conteo_Merma) 
                    FROM mermas 
                    WHERE mermas.productos_idProductos = salida_mercancia.Productos_idProductos 
                    AND mermas.tabla_produccion_fecha_idTabla_Produccion = salida_mercancia.Tabla_Produccion_Fecha_idTabla_Produccion
                    AND mermas.Sucursales_idSucursales = salida_mercancia.Sucursales_idSucursales /* <--- ¡LÍNEA DESCOMENTADA! */
                ) as Total_Merma
            ')
            ->join('productos', 'productos.idProductos = salida_mercancia.Productos_idProductos', 'INNER')
            ->join('sucursales', 'sucursales.idSucursales = salida_mercancia.Sucursales_idSucursales', 'INNER')
            ->join('mercancia_sucursal', 'mercancia_sucursal.Salida_Mercancia_idSalida_Mercancia = salida_mercancia.idSalida_Mercancia', 'LEFT')
            ->where('salida_mercancia.Tabla_Produccion_Fecha_idTabla_Produccion', $idTablaProduccion)
            ->orderBy('sucursales.NombreSucursal', 'ASC')
            ->findAll();

        return !empty($resultados) ? $resultados : [];
    }

    

    public function ReporteSemanalDashboard($fechaInicio, $fechaFin)
    {
        // Para el semanal, sumamos las salidas y contamos las confirmaciones
        // Asumiendo que unes con la tabla de fechas para filtrar por un rango de días reales
        $resultados = $this
            ->select('
                productos.Nombre_Producto, 
                sucursales.NombreSucursal, 
                SUM(salida_mercancia.Cantidad_Salida) as Total_Enviado,
                COUNT(mercancia_sucursal.Confirmacion_Salida) as Total_Aceptado
            ')
            ->join('productos', 'productos.idProductos = salida_mercancia.Productos_idProductos', 'INNER')
            ->join('sucursales', 'sucursales.idSucursales = salida_mercancia.Sucursales_idSucursales', 'INNER')
            ->join('mercancia_sucursal', 'mercancia_sucursal.Salida_Mercancia_idSalida_Mercancia = salida_mercancia.idSalida_Mercancia', 'LEFT')
            ->join('tabla_produccion_fecha', 'tabla_produccion_fecha.idTabla_Produccion = salida_mercancia.Tabla_Produccion_Fecha_idTabla_Produccion', 'INNER')
            ->where('tabla_produccion_fecha.fecha >=', $fechaInicio) // Asegúrate de que tu tabla de fechas tenga la columna 'fecha'
            ->where('tabla_produccion_fecha.fecha <=', $fechaFin)
            ->groupBy('salida_mercancia.Sucursales_idSucursales, salida_mercancia.Productos_idProductos')
            ->orderBy('sucursales.NombreSucursal', 'ASC')
            ->findAll();

        return !empty($resultados) ? $resultados : [];
    }
}
