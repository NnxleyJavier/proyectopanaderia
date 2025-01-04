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


}
