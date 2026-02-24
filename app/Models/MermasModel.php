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
//ESTA ES BASADA EN LA FECHA DEL ID

    public function BuscarMermasActuales($id)
    {
        $query = $this->select('Conteo_Merma,productos_idProductos,username,Nombre_Producto,Categoria,idSupervision')
        ->join('users', 'users.id = mermas.users_id','left')
        ->join('productos', 'productos.idProductos = mermas.productos_idProductos','left')
        ->where('tabla_produccion_fecha_idTabla_Produccion', $id)
        ->findAll();

        return $query;


    }

    //ESTA ES BASADA EN LA DEL ID

    public function BuscarMermasActualesId($id)
    {
        $query = $this->select('Conteo_Merma,idSupervision')
        ->join('users', 'users.id = mermas.users_id','left')
        ->join('productos', 'productos.idProductos = mermas.productos_idProductos','left')
        ->where('idSupervision', $id)
        ->findAll();

        return $query;


    }



}