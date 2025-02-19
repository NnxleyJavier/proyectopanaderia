<?php
namespace App\Models;
use CodeIgniter\Model;

class Productos extends Model{

	protected $table     ='productos';
	protected $primaryKey='idProductos ';

	protected $returnType    ='array';
	protected $useSoftDeletes=false;

	protected $allowedFields=['Nombre_Producto','Valor_produccion','Url_Imagen','Valor_Venta','Categoria','Can_Predeterminada','Categoria'];

	protected $useTimestamps=false;
	protected $createdField ='created_at';
	protected $updatedField ='updated_at';
	protected $deletedField ='deleted_at';


	//  protected $validationRules   =[];
	//  protected $validationMessages=[];
	//  protected $skipValidation    =false;
	
	public function Buscar_productos(){
		$this->select('idProductos,Nombre_Producto');
		$query = $this->findAll();
		return $query;
	}
	public function Buscar_porNombre($Nombre){
		$this->select('idProductos')
		->where('Nombre_Producto', $Nombre);
		$query = $this->first();
		return $query;
	}

	public function Buscar_productosyCategorias(){
		$this->select('idProductos,Nombre_Producto,Categoria');
		$query = $this->findAll();
		return $query;
	}
	public function Buscar_productosyCategoriasparticular($Nombre){
		$this->select('idProductos,Nombre_Producto,Categoria')
		->where('Nombre_Producto', $Nombre)
		->orWhere('Categoria', $Nombre);
		$query = $this	->first();
		return $query;
	}

	public function Buscarlista(){
		$this->select('Nombre_Producto');
		$query = $this->findAll();
		return $query;
		
	}
	
	public function BuscarCantidadUso($productos) {
		$resultados = $this->select('idAlmacen, Nombre_Producto, Cantidad_uso, Cantidad_Existente, Nombre_Materia, Cantidad_medida')
			->join('productos_has_almacen', 'productos_has_almacen.Productos_idProductos = productos.idProductos', 'INNER')
			->join('almacen', 'almacen.idAlmacen = productos_has_almacen.Almacen_idAlmacen', 'INNER')
			->join('referencias_almacen', 'referencias_almacen.idReferencias_Almacen = almacen.Referencias_Almacen_idReferencias_Almacen', 'LEFT')
			->where('Nombre_Producto', $productos)
			->findAll();
	
		if (empty($resultados)) {
			return false;
		}
	
		return $resultados;
	}

	public function Buscar_productos_id($id){
	return $this->select('Nombre_Producto')
	->where('idProductos', $id)
	->first();
	}

	public function CambiarValorPredeterminado($Nombre_Producto, $Categoria, $Cantidad) {
		$this->set('Can_Predeterminada', $Cantidad)
			->groupStart()
			->where('Nombre_Producto', $Nombre_Producto)
			->orWhere('Categoria', $Categoria)
			->groupEnd()
			->update();
	}


}

?>
