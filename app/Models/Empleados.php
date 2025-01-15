<?php

namespace App\Models;

use CodeIgniter\Model;

class Empleados extends Model
{

    protected $table            = 'empleados';
    protected $primaryKey       = 'idEmpleados';
 
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    
    protected $allowedFields    = ['Nombre','Apellidos','Cargo','Numero_Telefonico'];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function BuscarNombre($idUser){

        $resultado = $this->select('Nombre,NombreSucursal,idSucursales')
        ->join('sucursales', 'sucursales.Empleados_idEmpleados = empleados.users_id','left')
    ->where('users_id', $idUser)
    ->first();
    return $resultado;


    }

}
