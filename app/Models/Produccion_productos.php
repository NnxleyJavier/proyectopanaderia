<?php
namespace App\Models;
use CodeIgniter\Model;

class Produccion_productos extends Model{

	protected $table     ='produccion_productos';
	protected $primaryKey='idProduccion_Productos';

	protected $returnType    ='array';
	protected $useSoftDeletes= false;

	protected $allowedFields=['Cantidad_Realizada','Productos_idProductos'];

	protected $useTimestamps=false;
	protected $createdField ='created_at';
	protected $updatedField ='updated_at';
	protected $deletedField ='deleted_at';


	//  protected $validationRules   =[];
	//  protected $validationMessages=[];
	//  protected $skipValidation    =false;



}

?>
