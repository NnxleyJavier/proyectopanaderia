<?php
namespace App\Models;
use CodeIgniter\Model;

class Corroborar extends Model{

	protected $table     ='corroborar';
	protected $primaryKey='idcorroborar';

	protected $returnType    ='array';
	protected $useSoftDeletes=false;

	protected $allowedFields=['Fecha_edicion','Cantidad_cambio_Existente','Cantidad_Existente_Sistema','Almacen_idAlmacen'
		,'Almacen_Referencias_Almacen_idReferencias_Almacen','Motivo_del_Cambio'];

	protected $useTimestamps=false;
	protected $createdField ='created_at';
	protected $updatedField ='updated_at';
	protected $deletedField ='deleted_at';


	//  protected $validationRules   =[];
	//  protected $validationMessages=[];
	//  protected $skipValidation    =false;



}

?>
