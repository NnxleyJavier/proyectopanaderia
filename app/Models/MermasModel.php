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
        $query = $this->query("SELECT MAX(tabla_produccion_fecha_idTabla_Produccion) as max_id FROM mermas");
        $result = $query->getRowArray();

        if ($result) {
            return $result['max_id'];
        } else {
            return false; // Retorna false si NO hay resultados
        }

    }

    public function BuscarMermasActuales($id)
    {
        $query = $this->query("SELECT * FROM mermas WHERE tabla_produccion_fecha_idTabla_Produccion = $id");
        return $query->getResultArray();
    }


   
}
