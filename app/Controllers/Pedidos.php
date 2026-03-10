<?php

namespace App\Controllers;

use App\Models\Almacen;
use CodeIgniter\Shield\Models\UserModel;
use App\Models\Productos;
use App\Models\PedidosModel;
use App\Models\UtileriasSucursalesModel;
use App\Models\MermasModel;
use App\Models\Produccion_Deseada;
use App\Models\mermasfinalesdescompuestos;

class Pedidos extends BaseController
{
    public function index()
    {

        if (auth()->user()->inGroup('admin')) {

            $datos_Productos = new Productos();
            $select_Productos = $datos_Productos->Buscar_productos();


            $vistaProduccionDeseada =
                view('html/Cabecera') .
                view('html/menu') .
                view('html/pedidos',array('Productos' => $select_Productos));

            return $vistaProduccionDeseada;



        }else{

            $datos_Productos = new Productos();
            $select_Productos = $datos_Productos->Buscar_productos();


            $vistaProduccionDeseada =
                view('html/Cabecera') .
                view('html/menuvendedoras') .
                view('html/pedidos',array('Productos' => $select_Productos));

            return $vistaProduccionDeseada;
        }




    }

    public function AgregarPedidos()
    {
        $modeloPedidos = new PedidosModel();
        $Formulario_Pedidos = $this->validarforpedidos();
        $modeloPedidos->insert($Formulario_Pedidos);

        
    }

    private function validarforpedidos()
	{


		if ($this->request->getPost()) {
			$Nombre_Cliente = trim($this->request->getPost("cliente"));
			$Fecha_Pedido = trim($this->request->getPost("fecha"));
			$Cantidad_requerida = trim($this->request->getPost("cantidad"));
			$Productos_idProductos = trim($this->request->getPost("Nombre_Producto"));
		}
		if (
			isset($Nombre_Cliente) && !empty($Nombre_Cliente) &&
			isset($Fecha_Pedido) && !empty($Fecha_Pedido) &&
			isset($Cantidad_requerida) && !empty($Cantidad_requerida) &&
			isset($Productos_idProductos) && !empty($Productos_idProductos)

		) {
			$validarformpedidos = array(
				"Nombre_Cliente" => $Nombre_Cliente,
				"Fecha_Pedido" => $Fecha_Pedido,
				"Cantidad_requerida" => $Cantidad_requerida,
				"Productos_idProductos" => $Productos_idProductos

			);
			
			return $validarformpedidos;
        } else {
			echo "❌ Error: Faltan campos obligatorios.";
			return false;
		}
	}

	public function notify()
    {
        return $this->response->setJSON([
            'title' => 'Hola!',
            'message' => 'Este es un mensaje de notificación.',
        ]);
    }

	
	public function PedidosLimpieza(){

		$controlerHome = new Home();

		echo ($controlerHome->ObtenerId_User());
 		$IdUsuario=$controlerHome->ObtenerId_User();

		$Fecha_Pedido = $controlerHome->fecha();

		$datos_Productos = new Almacen();
        $Almaceb_Productos = $datos_Productos->Buscarproductos_almacen();


        $vistaUtileria =
        view('html/Cabecera') .
        view('html/menuvendedoras') .
        view('html/Solicitud_Productos',array('Almacen' => $Almaceb_Productos,'user_id' => $IdUsuario,'fecha' => $Fecha_Pedido));

    	return $vistaUtileria;
	}







	public function AgregarPedidosLimpieza()
	{
		$modeloPedidosUtileria = new UtileriasSucursalesModel();
		$Formulario_Pedidos = $this->validarpedidosLimpieza();
		var_dump($Formulario_Pedidos);
		$modeloPedidosUtileria->insert($Formulario_Pedidos);

		
	}


	 //ESTA FUNCION ESTA MUY COMPLETA POR QUE SE DEJA GUIAR POR LAS SUCURSALES SI EL USUARIO NO PERTENECE A NINGUNA SUCURSAL NO SE PODRA MOSTRAR SU SOLICITUD DE MATERIALES

	public function PedidosdeMaterialConfirmacion(){
	
		$Lista_Solicitudes_Pendientes = new UtileriasSucursalesModel();

		$Listado = $Lista_Solicitudes_Pendientes->ObtenerSolicitudesPendientes();

		d($Listado);

        $vistaUtileria =
        view('html/Cabecera') .
        view('html/menu') .
        view('html/ConfirmacionesUtileria',array('Listado' => $Listado));

    return $vistaUtileria;
		
	}


	public function Registrar_Solicitud_Material(){

		$ModeloUtileria = new UtileriasSucursalesModel();

		var_dump($this->validarConfirmacionPedido());

		$formConfirmacion = $this->validarConfirmacionPedido();

		//$ModeloUtileria->insert($formConfirmacion);
			// Actualizar la base de datos
		$ModeloUtileria->where('Id_Utilerias_Sucursales', $formConfirmacion['Id_Utilerias_Sucursales'])->set($formConfirmacion)->update();


		//Operacion para restar lo solicitado del almacen
		$Almacen = new Almacen();

		$Cantidad_Existente = $Almacen->Buscar_almacen_Cantidad($formConfirmacion['Id_Almacen']);

		$Cantidad_Existente = $Cantidad_Existente['Cantidad_Existente'];

		$Cantidad_por_Actualizar = $Cantidad_Existente - $formConfirmacion['Cantidad_Pedido'];



		$Almacen->where('idAlmacen', $formConfirmacion['Id_Almacen'])->set('Cantidad_Existente', $Cantidad_por_Actualizar)->update();

		//echo "Se ha actualizado la solicitud de material";


		//echo "Se ha actualizado la solicitud de material";
		//echo "Se ha actualizado la solicitud de material";
		//echo "Se ha actualizado la solicitud de material";
		// falta reducir del almacen 
		


	}



	
	private function validarConfirmacionPedido()
	{
		$controlerHome = new Home();
		$Fecha_Envio = $controlerHome->fecha();

		if ($this->request->getPost()) {

			$Id_Utilerias_Sucursales = trim($this->request->getPost("Id_Utilerias_Sucursales"));
			$Id_Almacen = trim($this->request->getPost("Id_Almacen"));
			$Cantidad_Pedido = trim($this->request->getPost("Cantidad_Pedido"));
			$Nombre_Materia = trim($this->request->getPost("Nombre_Materia"));
			$Estatus = trim($this->request->getPost("Estatus"));
			$Fecha_Solicitud = trim($this->request->getPost("Fecha_Solicitud"));
			$NombreSucursal = trim($this->request->getPost("NombreSucursal"));
			$Nombre = trim($this->request->getPost("Nombre"));
			$seleccionado = trim($this->request->getPost("seleccionado"));
			if (
				isset($Id_Utilerias_Sucursales) && !empty($Id_Utilerias_Sucursales) &&
				isset($Cantidad_Pedido) && !empty($Cantidad_Pedido) &&
				isset($Nombre_Materia) && !empty($Nombre_Materia) &&
				isset($Estatus) && !empty($Estatus) &&
				isset($Fecha_Solicitud) && !empty($Fecha_Solicitud) &&
				isset($NombreSucursal) && !empty($NombreSucursal) &&
				isset($Nombre) && !empty($Nombre) &&
				isset($seleccionado) && !empty($seleccionado)&&
				isset($Id_Almacen) && !empty($Id_Almacen)

			) {
				$validarSolicitud = array(
					"Id_Utilerias_Sucursales" => $Id_Utilerias_Sucursales,
					"Cantidad_Pedido" => $Cantidad_Pedido,
					"Nombre_Materia" => $Nombre_Materia,
					"Estatus" => 'Resuelto',
					"Fecha_Envio" => $Fecha_Envio,
					"Id_Almacen" => $Id_Almacen
				//	"Fecha_Solicitud" => $Fecha_Solicitud,
				//	"NombreSucursal" => $NombreSucursal,
					//"Nombre" => $Nombre,
					//"seleccionado" => $seleccionado
				);

				return $validarSolicitud;
			} else {
				echo "❌ Error: Faltan campos obligatorios.";
				return false;
			}
		} else {
			echo "❌ Error: La solicitud no es AJAX.";
			return false;
		}
	}


	private function validarpedidosLimpieza(){
		$controlerHome = new Home();

		if ($this->request->getPost()) {
			$Cantidad_Pedido = trim($this->request->getPost("Cantidad_Pedido"));
			$almacen_idAlmacen = trim($this->request->getPost("almacen_idAlmacen"));
			$Fecha_Pedido = $Fecha_Pedido = $controlerHome->fecha();
			$User_id = trim($this->request->getPost("users_id"));
		}
		if (
			$almacen_idAlmacen !== 'sin_dato'||
			isset($Cantidad_Pedido) && !empty($Cantidad_Pedido) &&
			isset($almacen_idAlmacen) && !empty($almacen_idAlmacen) &&
			isset($Fecha_Pedido) && !empty($Fecha_Pedido) && 
			isset($User_id) && !empty($User_id)

		) {
			$validarformpedidos = array(
				"Cantidad_Pedido" => $Cantidad_Pedido,
				"almacen_idAlmacen" => $almacen_idAlmacen,
				"Fecha_Solicitud" => $Fecha_Pedido,
				"users_id" => $User_id,
				"Estado" => "Pendiente",
				"Fecha_Entrega" => Null

			);
			
			return $validarformpedidos;
		} else {
			echo "❌ Error: Faltan campos obligatorios.";
			return false;
		}

	}




	
public function Consultamermas()
    {
        $ListaMermas = new MermasModel();
        
        // Optimizacion: Casteo directo a int en una sola linea
        $IdUltimaFecha = (int)$ListaMermas->BuscarNumeroMasAlto();

        $lista_productos = new Productos();
        $model_Produccion_Deseada = new Produccion_Deseada();

        $productos = $lista_productos->Buscarlistauno();
        $iteraciones = count($productos);

        // Tu logica actual de iteración
        for ($i = 0; $i < $iteraciones;) {
            $result = $model_Produccion_Deseada->BuscarProductosDeseados($productos[$i]);
            if ($result == null) {
                $i++;
            } else {
                $resultados[] = $result;
                $i++;
            }
        }

        if ($IdUltimaFecha == false || $IdUltimaFecha == 0) {
            // Es recomendable retornar una vista vacía o un mensaje en lugar de solo echo
            echo("no hay mermas"); 
        } else {
            // 1. Obtenemos todas las mermas
            $ListaMermasActuales = $ListaMermas->BuscarMermasActuales($IdUltimaFecha);

            // ---------------------------------------------------------
            // 2. FILTRO: Eliminar mermas con cantidad 0
            // ---------------------------------------------------------
            if (!empty($ListaMermasActuales)) {
                $ListaMermasActuales = array_filter($ListaMermasActuales, function ($merma) {
                    // Asumo que el campo se llama 'Conteo_Merma' basado en tus comentarios anteriores.
                    // Si el campo en tu BD es 'cantidad', cambia 'Conteo_Merma' por 'cantidad'.
                    return $merma['Conteo_Merma'] > 0;
                });
            }
            // ---------------------------------------------------------

            // (Opcional) Si después de filtrar el arreglo queda vacío, podrías mostrar mensaje de que no hay mermas
            if (empty($ListaMermasActuales)) {
                 echo("Todas las mermas estan en 0");
                 // O retornar la vista sin datos
            }

            return view('html/Cabecera') .
                view('html/menu') .
                view('html/mermas', array('ListaMermas' => $ListaMermasActuales));
        }
    }



public function ActualizarMermas(){

		$modeloMermas = new mermasfinalesdescompuestos();
		$Formulario_Mermas = $this->validarDatosMerma();
		var_dump($Formulario_Mermas);
		$id_merma = $Formulario_Mermas['mermas_idSupervision'];
		echo "el id de la merma es ".$id_merma;
		$ListaMermas = new MermasModel();
		$cuantohayactual = $ListaMermas->BuscarMermasActualesId($id_merma);

		var_dump($cuantohayactual);

		$totalyarestado = $cuantohayactual[0]['Conteo_Merma'] - $Formulario_Mermas['Cantidad_Eliminar'];
		echo "el total ya restado es ".$totalyarestado;	



	$ActualizarMermaGeneral = array(
		"Conteo_Merma" => $totalyarestado
	);
	$ListaMermas->where('idSupervision', $id_merma)->set($ActualizarMermaGeneral)->update();



		$modeloMermas->insert($Formulario_Mermas);


		// YA REGISTRA  LAS MERMAS FINALES DE LOS DESCOMPUESTOS SOLO FALTA HACER LA RESTA EN LA MERMA GENERAL PARA QUE QUEDEN ACTUALIZADAS LAS MERMAS TOTALES

		
	}

private function validarDatosMerma()
{
    // 1. Verificar si hay datos POST
    if (!$this->request->getPost()) {
        return false;
    }

    // 2. Obtener y limpiar datos
    $id_merma = trim($this->request->getPost("id_merma"));
    $razon_eliminacion = trim($this->request->getPost("razon_eliminacion"));
    $cantidad = trim($this->request->getPost("cantidad"));

    // 3. Validar que no estén vacíos
    if (!empty($id_merma) && !empty($razon_eliminacion) && !empty($cantidad)) {
        
        // Retornamos el array listo para insertar/actualizar
        return [
            "mermas_idSupervision"          => $id_merma,
            "razon_eliminacion" => $razon_eliminacion,
            "Cantidad_Eliminar"          => $cantidad
        ];
    }

    // Si falta algún dato, devolvemos false
    return false;
}
	


}