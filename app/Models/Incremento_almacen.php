<?php
namespace App\Models;
use CodeIgniter\Model;

class Incremento_almacen extends Model{

	protected $table     ='incremento_almacen';
	protected $primaryKey='idIncremento_Almacen';

	protected $returnType    ='array';
	protected $useSoftDeletes=false;

	protected $allowedFields=['Almacen_idAlmacen','Fecha_de_Ingreso','Cantidad_Ingresada'];

	protected $useTimestamps=false;
	protected $createdField ='created_at';
	protected $updatedField ='updated_at';
	protected $deletedField ='deleted_at';


	//  protected $validationRules   =[];
	//  protected $validationMessages=[];
	//  protected $skipValidation    =false;


}

?>
