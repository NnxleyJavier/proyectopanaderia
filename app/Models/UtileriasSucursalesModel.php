<?php

namespace App\Models;

use CodeIgniter\Model;

class UtileriasSucursalesModel extends Model
{
    
    protected $table            = 'utilerias_sucursales';
    protected $primaryKey       = 'Id_Utilerias_Sucursales';
   
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
   
    protected $allowedFields    = ['Cantidad_Pedido','Estatus','Fecha_Solicitud','Fecha_Envio','users_id','almacen_idAlmacen'];

    // Dates
    protected $useTimestamps = false;
   
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    function ObtenerSolicitudesPendientes(){

        $resultados = $this
        ->select('Id_Utilerias_Sucursales,Cantidad_Pedido,Estatus,Fecha_Solicitud,almacen.Nombre_Materia,almacen.idAlmacen,users.username,empleados.Nombre,
        sucursales.NombreSucursal')
        ->join('almacen', 'almacen.idAlmacen = utilerias_sucursales.almacen_idAlmacen ', 'INNER')
        ->join('users', 'users.id = utilerias_sucursales.users_id ', 'INNER')
        ->join('empleados', 'empleados.users_id = users.id ', 'INNER')
        ->join('sucursales', 'sucursales.Empleados_idEmpleados = empleados.idEmpleados ', 'INNER')
        ->where('Estatus', 'Pendiente')
        ->findAll();

    // Devolver un arreglo vacío si no hay resultados
    return !empty($resultados) ? $resultados : [];
    }

} 
