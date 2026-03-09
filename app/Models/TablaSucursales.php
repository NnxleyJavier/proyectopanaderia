<?php

namespace App\Models;

use CodeIgniter\Model;

class TablaSucursales extends Model
{
   
    protected $table            = 'sucursales';
    protected $primaryKey       = 'idSucursales';
   
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
 
    protected $allowedFields    = ['NombreSucursal','Direccion_Sucursal','Empleados_idEmpleados'];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

	public function Buscar_Sucursales(){
		$this->select('idSucursales,NombreSucursal');
		$query = $this->findAll();
		return $query;
	}
public function ObtenerSucursalPorUsuario($idUsuario)
    {
        // Ajusta 'idSucursales' y 'NombreSucursal' según tus columnas exactas si varían
        return $this->select('sucursales.idSucursales, sucursales.NombreSucursal')
                    ->join('empleados', 'empleados.idEmpleados = sucursales.Empleados_idEmpleados', 'INNER')
                    ->where('empleados.users_id', $idUsuario)
                    ->first(); // first() nos devuelve un solo arreglo asociativo
    }

}
