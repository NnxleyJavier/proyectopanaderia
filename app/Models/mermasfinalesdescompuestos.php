<?php

namespace App\Models;

use CodeIgniter\Model;

class mermasfinalesdescompuestos extends Model
{

    protected $table            = 'mermasfinalesdescompuestos';
    protected $primaryKey       = 'idMermasfinalesdescompuestos';
 
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;


    protected $allowedFields    = ['razon_eliminacion','Cantidad_Eliminar','mermas_idSupervision'];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';



}
    