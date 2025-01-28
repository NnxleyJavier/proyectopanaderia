<?php

namespace App\Models;

use CodeIgniter\Model;

class MermasModel extends Model
{
   
    protected $table            = 'mermas';
    protected $primaryKey       = 'idSupervision';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'Conteo_Merma',
        'productos_idProductos',
        'tabla_produccion_fecha_idTabla_Produccion',
        'users_id'
    ];

    // Dates
    protected $useTimestamps = false;
   
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function BuscarNumeroMasAlto()
    {
        $query = $this->query("SELECT MAX(tabla_produccion_fecha_idTabla_Produccion) as tabla_produccion_fecha_idTabla_Produccion FROM mermas");
        $query = $this->first();
        
        if ($query) {
    
            return $query;
        
            }
             else {
               
                 
                return false; // Retorna false si no hay pedidos
            }

    }

    public function BuscarMermasActuales($id)
    {
        $query = $this->query("SELECT * FROM mermas WHERE tabla_produccion_fecha_idTabla_Produccion = $id");
        return $query->getResultArray();
    }


   
}
