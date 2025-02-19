<?php
namespace App\Models;
use CodeIgniter\Model;

class Almacen extends Model{

    protected $table     ='almacen';
    protected $primaryKey='idAlmacen';

    protected $returnType    ='array';
    protected $useSoftDeletes=false;

    protected $allowedFields=['Nombre_Materia','Cantidad_Existente','Cantidad_Existente','imagen_ref',];

    protected $useTimestamps=false;
    protected $createdField ='created_at';
    protected $updatedField ='updated_at';
    protected $deletedField ='deleted_at';


  //  protected $validationRules   =[];
  //  protected $validationMessages=[];
  //  protected $skipValidation    =false;
	public function Buscarproductos_almacen(){
		$this->select('*');
		$this->join('referencias_almacen', 'referencias_almacen.idReferencias_Almacen = almacen.Referencias_Almacen_idReferencias_Almacen','left');
		$query = $this->findAll();
		return $query;
	}

	public function Buscar_almacen($Dato_a_Buscar,$Id_Busqueda){
		$this->select("$Dato_a_Buscar");
		$this->join('referencias_almacen', 'referencias_almacen.idReferencias_Almacen = almacen.Referencias_Almacen_idReferencias_Almacen','left');
		$this->where('idAlmacen',$Id_Busqueda);
		$query = $this->first();
		return $query;
	}

	public function Buscar_almacen_Cantidad($Id_Busqueda){
		$this->select('Cantidad_Existente');
		$this->where('idAlmacen',$Id_Busqueda);
		$query = $this->first();
		return $query;
	}
	
	public function Buscar_almacen_Cantidad_medida($Id_Busqueda){
		$this->select('Cantidad_medida');
		$this->join('referencias_almacen', 'referencias_almacen.idReferencias_Almacen = almacen.Referencias_Almacen_idReferencias_Almacen','left');
		$this->where('idAlmacen',$Id_Busqueda);
		$query = $this->first();
		return $query;
	}


	public function Buscar_Almacen_especifico(){
		$this->select('idAlmacen,Nombre_Materia');
		$query = $this->findAll();
		return $query;
	}
	public function actualizaryagenerado($cuanto,$aque){

		$this->update($cuanto);
		$this->where('idAlmacen',$aque);
		$query = $this->first();
		return $query;
	}
}

?>
