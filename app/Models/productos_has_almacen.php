<?php
namespace App\Models;
use CodeIgniter\Model;

class productos_has_almacen extends Model{

	protected $table     ='productos_has_almacen';
	protected $primaryKey='Productos_idProductos';

	protected $returnType    ='array';
	protected $useSoftDeletes= false;

	protected $allowedFields=['Almacen_idAlmacen','Cantidad_uso','Productos_idProductos '];

	protected $useTimestamps=false;
	protected $createdField ='created_at';
	protected $updatedField ='updated_at';
	protected $deletedField ='deleted_at';


	//  protected $validationRules   =[];
	//  protected $validationMessages=[];
	//  protected $skipValidation    =false;



}

?>
