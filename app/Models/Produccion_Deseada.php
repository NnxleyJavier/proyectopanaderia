<?php
namespace App\Models;
use CodeIgniter\Model;

class Produccion_Deseada extends Model{

	protected $table     ='produccion_deseada';
	protected $primaryKey='idProduccion_Deseada';

	protected $returnType    ='array';
	protected $useSoftDeletes=false;

	protected $allowedFields=['Fecha_Registro','Cantidad_requerida','Productos_idProductos'];

	protected $useTimestamps=false;
	protected $createdField ='created_at';
	protected $updatedField ='updated_at';
	protected $deletedField ='deleted_at';


	//  protected $validationRules   =[];
	//  protected $validationMessages=[];
	//  protected $skipValidation    =false;


	public function BuscarProductosDeseados($productos){
		return $this->select('*')
		->join('productos', 'productos.idProductos = produccion_deseada.Productos_idProductos','left')
		-> where('Nombre_Producto', $productos)
		->orderBy('Fecha_Registro', 'DESC')
		->first();
	
	}
}

//$this->db->select('*');
//$this->db->from('productos'); // Nombre de la tabla
//$this->db->where('nombre', $nombre);
//$this->db->order_by('fecha', 'DESC'); // Ordena por fecha en orden descendente
//$this->db->limit(1); // Obtiene solo el primer registro
//$query = $this->db->get();
//return $query->row(); // Devuelve el registro más reciente

?>

