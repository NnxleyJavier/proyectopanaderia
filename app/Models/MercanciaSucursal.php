<?php

namespace App\Models;

use CodeIgniter\Model;

class MercanciaSucursal extends Model
{

    protected $table            = 'mercancia_sucursal';
    protected $primaryKey       = 'idPedidos ';
 
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['Confirmacion_Salida','Nota','Salida_Mercancia_idSalida_Mercancia'];

    // Dates
    protected $useTimestamps = false;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function FuncionBusqueda($fecha,$IdSucursal){

        $resultado = $this->select('idPedidos,Nota,idSalida_Mercancia,Sucursales_idSucursales')
        ->join('salida_mercancia', 'salida_mercancia.idSalida_Mercancia = mercancia_sucursal.Salida_Mercancia_idSalida_Mercancia','left')
        ->where('Tabla_Produccion_Fecha_idTabla_Produccion', $fecha)
        ->where('Sucursales_idSucursales', $IdSucursal)
        ->findAll();
    return $resultado;

    }


}
