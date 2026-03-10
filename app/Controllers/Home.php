<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Almacen;
use App\Models\auth_groups_users;
use App\Models\Incremento_almacen;
use App\Models\Corroborar;
use App\Models\Empleados;
use App\Models\Productos;
use App\Models\productos_has_almacen;
use App\Models\Produccion_Deseada;
use App\Models\Produccion_productos;
use App\Models\SalidaMercancia;
use App\Models\TablaProduccionFecha;
use App\Models\TablaProduccionFechaHasProductos;
use App\Models\TablaSucursales;
use App\Models\MercanciaSucursal;
use App\Models\MermasModel;
use App\Models\PedidosModel;
use CodeIgniter\Shield\Models\UserModel;
//RAMA LOCAL
class Home extends BaseController
{
    public function fecha()
    {
        date_default_timezone_set('America/Mexico_City'); // O la zona horaria que necesites
        $fecha = date("Y-m-d");
        return $fecha;
    }

   public function index() // <--- Nota: Quité ": string" para que acepte redirecciones
    { 
        $Empleado = new Empleados();
        $idUser = $this->ObtenerId_User(); // obtengo el id User de la Sesion

        // --- VALIDACIÓN DE SEGURIDAD ---
        // Si no hay ID (es nulo, falso o 0), mandamos al login
        if (!$idUser) {
            return redirect()->to('/login');
        }

        $ConsultaUsuario = $Empleado->BuscarNombre($idUser); 

        // Validación extra: Si tiene ID pero NO se encontraron datos del empleado
        if (!$ConsultaUsuario) {
             return redirect()->to('/login');
        }

        $nombreUsuario = $ConsultaUsuario['Nombre']; // Extraer solo el nombre

        // Optimizamos el Switch para no repetir código
        // Definimos una variable para el menú según el grupo
        $menuView = 'html/menu'; // Menú por defecto

        if (auth()->user()->inGroup('user')) {
            $menuView = 'html/menuPanadero';
        } elseif (auth()->user()->inGroup('ventas')) {
            $menuView = 'html/menuvendedoras';
        } elseif (auth()->user()->inGroup('distribucion')) {
            $menuView = 'html/menudistribucion';
        }
        // Si es admin o default, se queda con 'html/menu'

        // Armamos la vista final una sola vez
        $vistaBienvenido = view('html/CabeceraBienvenida') .
                           view($menuView) .
                           view('html/Bienvenido', array('DataNombre' => $nombreUsuario));

        return $vistaBienvenido;
    }

    // vista: en esta vista se registra la llegada de material para incrementar en la tabla de almacen
    public function paginaprincipal()
    {
        $datos_almacen = new Almacen();

        $select_Almacen = $datos_almacen->Buscarproductos_almacen();

        $count = $datos_almacen->resultID->num_rows;

        d($select_Almacen);
        $vistaAlmacen =
            view('html/Cabecera') .
            view('html/menu') .
            view('html/index', array('datos' => $select_Almacen, 'count' => $count));


        return $vistaAlmacen;
    }

    public function MandarAlmacen()
    {

        $datos_almacen = new Almacen();
        if ($this->validarformalmacen() == true) {
            $data['token'] = csrf_hash();

            $Formulario_Almacen_Incremento = $this->validarformalmacen();

            $Id_de_Almacen = $Formulario_Almacen_Incremento['Almacen_idAlmacen'];

            $select_Almacen = $datos_almacen->Buscar_almacen('Medida', $Id_de_Almacen);

            $Tipo_de_Medicion = $Formulario_Almacen_Incremento['Tipo_Medicion'];


            if (implode($select_Almacen) == $Tipo_de_Medicion) {
                //comparacion en tipo de medicion para poder capturar el aumenyo de almacen
                $Tabla_Incremento_Almacen = new Incremento_Almacen();

                //CONSULTAS CUANTO EXISTE EN ALMACEN
                $Id_Consulta = $datos_almacen->Buscar_almacen_Cantidad($Id_de_Almacen);
                $Id_Consulta_Limpio = implode($Id_Consulta);
                //echo $Id_Consulta_Limpio;
                $Suma_de_Ingreso_Almacen = ($Id_Consulta_Limpio + $Formulario_Almacen_Incremento['Cantidad_Ingresada']);

                //QUE SE VEA REPERCUCIONES EN EL ALMACEN, PARA QUE AUMENTE EL NUMERO DE PRODUCTO
                $datos_almacen->where('idAlmacen', $Id_de_Almacen)->set('Cantidad_Existente', $Suma_de_Ingreso_Almacen)->update();

                //INCREMENTA YA LA SUMA AL ALMACÉN. COMPROBAR SI SE REALIZA LA OPERACIÓN ANTERIOR. SE REALICE ESTA.
                $Tabla_Incremento_Almacen->insert($Formulario_Almacen_Incremento);
            } else {
                //Aqui podemos poner si el usuario introduce otro tipo de medida, y hacemos la proporcion
                echo("se suman por unidad");
                $Cantidad_medida = $datos_almacen->Buscar_almacen_Cantidad_medida($Id_de_Almacen);
                //comparacion en tipo de medicion para poder capturar el aumenyo de almacen
                $Tabla_Incremento_Almacen = new Incremento_Almacen();

                //CONSULTAS CUANTO EXISTE EN ALMACEN
                $Id_Consulta = $datos_almacen->Buscar_almacen_Cantidad($Id_de_Almacen);
                $Id_Consulta_Limpio = implode($Id_Consulta);
                //operacion para saber cuanto se va a sumar al almacen
                $PorPieza = $Formulario_Almacen_Incremento['Cantidad_Ingresada'] / implode($Cantidad_medida);
                $Suma_de_Ingreso_Almacen = ($Id_Consulta_Limpio + $PorPieza);


                //QUE SE VEA REPERCUCIONES EN EL ALMACEN, PARA QUE AUMENTE EL NUMERO DE PRODUCTO
                $datos_almacen->where('idAlmacen', $Id_de_Almacen)->set('Cantidad_Existente', $Suma_de_Ingreso_Almacen)->update();

                //INCREMENTA YA LA SUMA AL ALMACÉN. COMPROBAR SI SE REALIZA LA OPERACIÓN ANTERIOR. SE REALICE ESTA.
                $Tabla_Incremento_Almacen->insert($Formulario_Almacen_Incremento);


            }
        } else {
            echo(" Datos incompletos");
        }
    }


    public function MandarCorroboracion()
    {

        if ($this->validarformcorroboracion() == true) {
            $data['token'] = csrf_hash();

            //var_dump($this->validarformcorroboracion());
            $datos_almacen = new Almacen();
            $Formulario_Corroboracion = $this->validarformcorroboracion();

            $select_Almacen = $datos_almacen->Buscar_almacen('Cantidad_Existente', $Formulario_Corroboracion['Almacen_idAlmacen']);
            $Cantidad_Existente = implode($select_Almacen);

            $Formulario_Corroboracion["Cantidad_Existente_Sistema"] = $Cantidad_Existente;

            $Modelo_Corroboracion = new Corroborar();

            $Modelo_Corroboracion->insert($Formulario_Corroboracion);

            $Id_Consulta_Limpio = $Formulario_Corroboracion['Almacen_idAlmacen'];
            $Cantidad_Corroboracion = $Formulario_Corroboracion['Cantidad_cambio_Existente'];

            $datos_almacen->where('idAlmacen', $Id_Consulta_Limpio)->set('Cantidad_Existente', $Cantidad_Corroboracion)->update();
            //var_dump($Formulario_Corroboracion);
            echo("se actualizo el valor del almacen : " . $Cantidad_Existente . " Por este valor nuevo: " . $Cantidad_Corroboracion);
        } else {
            echo("   algun valor hace falta por rellenar ");
        }
    }


    public function MandarProducto_Gasto()
    {

        if ($this->ValidarFormulario_Gastos() == true) {
            $data['token'] = csrf_hash();
            $model_producto_has_almacen = new productos_has_almacen();
            $Formulario = $this->ValidarFormulario_Gastos();

            var_dump($this->ValidarFormulario_Gastos());
            $model_producto_has_almacen->insert($Formulario);

            //	echo ("Producto Registrado ".$Formulario['Cantidad_uso']);
            return $this->response->setJSON($data);
        } else {


            echo("   algun valor hace falta por rellenar ");
        }
    }

    public function MandarProduccionDeseada()
    {

        if ($this->ValidarFormulario_productos_deseados() == true) {
            $data['token'] = csrf_hash();
            $model_producto_has_almacen = new Produccion_Deseada();
            $Formulario = $this->ValidarFormulario_productos_deseados();

            var_dump($this->ValidarFormulario_productos_deseados());
            $model_producto_has_almacen->insert($Formulario);

            //	echo ("Producto Registrado ".$Formulario['Cantidad_uso']);
            //return $this->response->setJSON($data);

        } else {


            echo("   algun valor hace falta por rellenar ");
        }
    }



    //vista para corroborrar las cantidades del almacen, ya que al ser un calculo el que se ocupa
    // para la realizacion del pan puede haber algunas variaciones

    public function Corroborar()
    {

        $datos_almacen = new Almacen();

        $select_Almacen = $datos_almacen->Buscarproductos_almacen();

        $count = $datos_almacen->resultID->num_rows;

        d($select_Almacen);
        $vistaAlmacen =
            view('html/Cabecera') .
            view('html/menu') .
            view('html/Corroborar', array('datos' => $select_Almacen, 'count' => $count));


        return $vistaAlmacen;
    }

    // Vista: en esta vista podemos relacionar los productos de venta (bolillo, conchas, etc),
    // con los productos que existen en el almacen (Harina, Manteca, etc) y fijar un gasto de cada producto

    public function Uso_Materia_Prima()
    {
        $datos_almacen = new Almacen();
        $datos_Productos = new Productos();
        $select_Almacen = $datos_almacen->Buscar_Almacen_especifico();
        $select_Productos = $datos_Productos->Buscar_productos();

        //	$count= $datos_almacen->resultID->num_rows;

        //d($select_Almacen);

        $vistaAlmacen =
            view('html/Cabecera') .
            view('html/menu') .
            view('html/Cantidades', array('Almacen' => $select_Almacen, 'Productos' => $select_Productos));

        return $vistaAlmacen;
    }



    // vista: muestra la pagina de registro de productos para venta por ejemplo el producto bolillo y el costo
    // que tiene como produccion y el costo que tiene como venta al publico
    public function Producto()
    {

        $vistaProduto =
            view('html/Cabecera') .
            view('html/menu') .
            view('html/Productos');

        return $vistaProduto;
    }

    public function MandarProducto()
    {


        if ($this->validarProducto() == true) {
            $data['token'] = csrf_hash();
            //var_dump($this->validarformcorroboracion());
            $model_producto = new Productos();
            $Formulario_Producto = $this->validarProducto();
            $model_producto->insert($Formulario_Producto);

            echo("Producto Registrado " . $Formulario_Producto['Nombre_Producto']);
            return $this->response->setJSON($data);
        } else {
            echo("   algun valor hace falta por rellenar ");
        }
    }

    // funcion para el panadero, para saber cuanto de pan va a hacer en el dia, esta funcion esta pensada
    // para que obtenga el valor de otra funcion de ventas y sobrantes para que se adecue el valor dependiendo de
    // de la produccion asignada y los sobrantes
  public function Produccion_Deseada()
    {
        // ... (Tu código previo de instancias y fecha sigue igual) ...
        $fecha = $this->fecha();
        $ConsultarPedidos = new PedidosModel();
        $lista_productos = new Productos();
        $ListaMermas = new MermasModel();
        $model_Produccion_Deseada = new Produccion_Deseada();

        // 1. Obtenemos datos preliminares
        $IdUltimaFecha = (int)$ListaMermas->BuscarNumeroMasAlto();
        $productos = $lista_productos->Buscarlista();
        $Pedidoshoy = $ConsultarPedidos->BuscarPedidoshoy($fecha);
        $PedidosTotal = $this->SumadeValoresporProductos($Pedidoshoy);

        // 2. Lógica de iteración (igual que tenías)
        $iteraciones = count($productos);
        $resultados = []; // Inicializamos array para evitar errores si está vacío
        
        for ($i = 0; $i < $iteraciones;) {
            $result = $model_Produccion_Deseada->BuscarProductosDeseados($productos[$i]);
            if ($result == null) {
                $i++;
            } else {
                $resultados[] = $result;
                $i++;
            }
        }

        // -----------------------------------------------------------------------
        // NUEVA LÓGICA DE VALIDACIÓN
        // -----------------------------------------------------------------------
        
        $mermasSonCero = true; // Asumimos que son cero hasta demostrar lo contrario
        $ListaMermasActuales = [];

        if ($IdUltimaFecha) {
            // Si hay un ID, traemos las mermas
            $ListaMermasActuales = $ListaMermas->BuscarMermasActuales($IdUltimaFecha);
            
            // Sumamos todas las cantidades de 'Conteo_Merma'
            $totalCantidad = array_sum(array_column($ListaMermasActuales, 'Conteo_Merma'));
            
            // Si la suma es mayor a 0, entonces SÍ hay mermas reales
            if ($totalCantidad > 0) {
                $mermasSonCero = false;
            }
        }

        // -----------------------------------------------------------------------
        // DECISIÓN: Entramos aquí si NO hay ID o si las mermas suman 0
        // -----------------------------------------------------------------------
        if ($IdUltimaFecha == false || $mermasSonCero == true) {
            
            echo("no hay mermas (o están en 0)");
            
            // No hacemos restas, pasamos $resultados tal cual

        } else {
            // -------------------------------------------------------------------
            // LÓGICA DE RESTA (Solo si hay mermas reales)
            // -------------------------------------------------------------------
            echo("si hay mermas");

            // Aquí hacemos la resta matemática que ya tenías
            foreach ($resultados as &$resultado) {
                foreach ($ListaMermasActuales as $merma) {
                    if ($resultado['idProductos'] == $merma['productos_idProductos']) {
                        // Validamos que exista la key para evitar errores
                         $cantidadRestar = $merma['Conteo_Merma'] ?? 0;
                         $resultado['Cantidad_requerida'] -= $cantidadRestar;
                    }
                }
            }
        }

        // -----------------------------------------------------------------------
        // RENDERIZADO DE VISTA (Unificado para no repetir código)
        // -----------------------------------------------------------------------
        
        // Determinamos qué menú usar según el rol
        $menuView = auth()->user()->inGroup('admin') ? 'html/menu' : 'html/menuPanadero';

        return view('html/Cabecera') .
               view($menuView) .
               view('html/ProduccionDeseada', array(
                   'datos' => $resultados, 
                   'Fecha' => $fecha, 
                   'ConsultaPedidos' => $PedidosTotal
               ));
    }


    /**
     * Suma las cantidades requeridas de productos en los pedidos de hoy.
     *
     * @param array $Pedidoshoy Un arreglo de pedidos, donde cada pedido es un arreglo asociativo que contiene 'Nombre_Producto' y 'Cantidad_requerida'.
     * @return array Un arreglo asociativo donde las claves son los nombres de los productos y los valores son las cantidades totales requeridas de cada producto.
     */
    private function SumadeValoresporProductos($Pedidoshoy)
    {
        try {
            $SumadePedidoshoy = [];

            if (empty($Pedidoshoy)) {
                throw new \Exception("No hay pedidos para hoy.");
            }

            foreach ($Pedidoshoy as $pedido) {
                $nombreProducto = $pedido['Nombre_Producto'];
                $cantidad = $pedido['Cantidad_requerida'];

                if (isset($SumadePedidoshoy[$nombreProducto])) {
                    $SumadePedidoshoy[$nombreProducto] += $cantidad;
                } else {
                    $SumadePedidoshoy[$nombreProducto] = $cantidad;
                }
            }

            return $SumadePedidoshoy;
        } catch (\Exception $e) {
            return false;
        }
    }


    // vista para introducir la produccion deseada con base a los sobrantes

    public function Vista_Produccion_deseada()
    {


        $datos_Productos = new Productos();
        $select_Productos = $datos_Productos->Buscar_productos();

        //	$count= $datos_almacen->resultID->num_rows;

        d($select_Productos);


        $vistaProduccionDeseada =
            view('html/Cabecera') .
            view('html/menu') .
            view('html/Vistaproducciondeseada', array('Productos' => $select_Productos));//,'ConsultaPedidos' => ));

        return $vistaProduccionDeseada;
    }

    // aqui voy a hacer una vista y una funcion para la paga del panadero y registar cuanto elabora realmente en la anterior era un supuesto ahora sera un numero real
    // aqui en esta funcion igual debe de descontar lo que ocupo en el almacen
    public function Vista_Produccion_Real()
    {
        $fecha = $this->fecha();

        $datos_Productos = new Productos();

        $select_Productos = $datos_Productos->Buscar_productos();

        $CantidadUso = $datos_Productos->BuscarCantidadUso("bolillo");


        //d($CantidadUso);
        //valor limpio de Cantidad_Uso
        // 100 va a ser variable
        //$multiplicacion = ($CantidadUso[1]['Cantidad_uso']) * 100;
        //$restaalmacen = ($CantidadUso[1]['Cantidad_Existente'] * $CantidadUso[1]['Cantidad_medida']) - ($multiplicacion);
        //echo ($CantidadUso[0]['idAlmacen']);

        $vistaProduccionDeseada =
            view('html/Cabecera') .
            view('html/menuPanadero') .
            view('html/Vistaproduccion', array('Productos' => $select_Productos,
                'Fecha' => $fecha, 'Consulta' => $this->ObtenerProduccionHoy($fecha)));

        return $vistaProduccionDeseada;
    }

    //corregir el insert con los nombres por eso hay problemas
    // corregir problema de que si no existe la cantidad de gasto mandar un error y no registrar nada ;
    public function Registro_de_produccion_de_hoy()
    {
        $idUser = $this->ObtenerId_User();

        if ($this->ValidarFormulario_productos($idUser) == true) {

            $fecha = $this->fecha();
            $data['token'] = csrf_hash();


            $modelAlmacen = new Almacen();
            $modeloTablaProduccionFecha = new TablaProduccionFecha();
            $modeloTablaProduccionFechaHasProduccionProductos = new TablaProduccionFechaHasProductos();
            $model_Produccion_producto = new Produccion_productos();
            $datos_Productos = new Productos();

            


            $Formulario_Producto = $this->ValidarFormulario_productos($idUser);
            //buscamos con el id del forulario que producto es el que escogio el usuario
            $Datobuscar = $datos_Productos->Buscar_productos_id($Formulario_Producto['Productos_idProductos']);
            //ya que estamos en contexto de a quien se le va a reducir la cantidad de kilos en el almacen
            //procedemos a hacer las operaciones aritmeticas solo que falta un forech
            $CantidadUso = $datos_Productos->BuscarCantidadUso($Datobuscar);

            //valor limpio de Cantidad_Uso
            $tamañodearreglo = count($CantidadUso);
            //	d($CantidadUso);
            // Insertamos la producción del producto y obtenemos el ID insertado
            $idInsertado = $model_Produccion_producto->insert($Formulario_Producto); // <<-- Se obtiene el ID del registro insertado

            if ($idInsertado) {

                for ($i = 0; $i < $tamañodearreglo; $i++) {

                    $multiplicacion = ($CantidadUso[$i]['Cantidad_uso']) * $Formulario_Producto['Cantidad_Realizada'];//0.3  multiplicamos lo que usa por la cantidad que se hizo osea manteca ocupa 0.003 de un kilo entonces lo multiplicamos por la cantidad que se hizo
                    $restaalmacen = ($CantidadUso[$i]['Cantidad_Existente'] * $CantidadUso[$i]['Cantidad_medida']) - ($multiplicacion);// 362.4 - 0.3 = 362.1  aqui multiplicamos la cantidad existente del almacen por la medida del contenedor eso nos da los kilos totales que hay en el almacen y le restamos lo que ocupo el panadero
                    $pasarmedida = ($restaalmacen / $CantidadUso[$i]['Cantidad_medida']);// con esta division obtenemos el valor pero en la medida base osea si es en bultos o cajas depende del contenedor

                    $data = [
                        'Cantidad_Existente' => $pasarmedida
                    ];

                    //var_dump($data);
                    // Actualizar la base de datos
                    $modelAlmacen->where('idAlmacen', $CantidadUso[$i]['idAlmacen'])->set($data)->update();
                }

                $FechaIdExiste = $modeloTablaProduccionFecha->UltimaFecha($fecha); //obtenemos el id de la fecha para relacionar
                //  var_dump($FechaIdExiste);

                //"TablaProduccionFecha_id"=>intval($FechaIdExiste['idTabla_Produccion']),
                //"Produccion_Productos_idProduccion_Productos"=>$idInsertado
                //	"Tabla_Produccion_idTabla_Produccion_Fecha "=>$FechaIdExiste
                //	"Produccion_Productos_idProduccion_Productos"=>$idInsertado


                $modeloTablaProduccionFechaHasProduccionProductos->insertar($FechaIdExiste, $idInsertado);

                echo("Producto Registrado " . $Formulario_Producto['Cantidad_Realizada'] . $tamañodearreglo . ' ' . $idInsertado . ' ' . $pasarmedida);
                echo("Numero usuario: " . $idUser);

                return $this->response->setJSON($modeloTablaProduccionFechaHasProduccionProductos);

            } else {
                return false;
                echo "ocurrio un error";
            }
        } else {
            echo("   algun valor hace falta por rellenar ");
        }
    }



// aqui es el registro de distribucion solo que estamos armando un condicional
// para que compare el registro de produccion y la distrubucion
// siguiendo la logica que si la produccion es 100 no podemos distribuir mas que eso
//Analizar por que dependiendo como se comporte
   public function AgregarDistribucion()
    {
        $modelSalidaMercancia = new SalidaMercancia(); 
        $modelProducto = new Productos(); 

        // 1. OBTENER TODOS LOS DATOS
        $fecha = $this->fecha();
        
        // Datos Individuales
        $prodHoy = $this->ObtenerProduccionHoy($fecha);
        $distHoy = $this->ObtenerDistribucionHoy(); 
        
        // Datos por Categoría (Usando la función mejorada del paso anterior si la tienes, o la normal)
        $prodHoyCat = $this->ObtenerProduccionHoyCategoria($fecha);
        $distHoyCat = $this->ObtenerDistribucionHoyCategoria(); 

        // Datos de Mermas (Tu función que mezcla Categorías y Nombres)
        $mermasTotal = $this->ObtenerMermasHoyCategoria(); 

        // 2. VALIDACIÓN DEL INPUT
        $formulario = $this->validarDistribucion();
        if (!$formulario) return;

        $inputProducto = $formulario['Productos_idProductos'];
        $CantidadSolicitada = (int)$formulario['Cantidad_Salida'];

        // 3. IDENTIFICAR EL PRODUCTO
        $datosProducto = $modelProducto->Buscar_productosyCategoriasparticular($inputProducto);
        
        // Búsqueda de respaldo por nombre
        if (!$datosProducto) {
            $busqueda = $modelProducto->Buscar_porNombre($inputProducto);
            if ($busqueda) {
                $datosProducto = $modelProducto->Buscar_productos_id($busqueda['idProductos']);
                if (isset($datosProducto[0])) $datosProducto = $datosProducto[0];
            }
        }

        if (!$datosProducto) {
            echo "❌ Error: Producto no encontrado en BD.";
            return;
        }

        $NombreProducto = trim($datosProducto['Nombre_Producto']);
        $Categoria = !empty($datosProducto['Categoria']) ? trim($datosProducto['Categoria']) : null;
        
        // Ajustamos el ID para guardar
        $formulario['Productos_idProductos'] = $datosProducto['idProductos']; 

        // -----------------------------------------------------------
        // 4. LÓGICA DE DISPONIBILIDAD (SUMA FLEXIBLE)
        // -----------------------------------------------------------

        $CantProduccion = 0;
        $CantMerma = 0;
        $CantYaDistribuida = 0;
        $NombreReferencia = ""; // Para mensajes de error

        // A) SI TIENE CATEGORÍA, USAMOS LOS ARREGLOS DE CATEGORÍA
        if ($Categoria) {
            $NombreReferencia = "Categoría: " . $Categoria;
            // Usamos '?? 0' para que si no existe, valga 0 en lugar de dar error
            $CantProduccion = $prodHoyCat[$Categoria] ?? 0;
            $CantMerma      = $mermasTotal[$Categoria] ?? 0;
            $CantYaDistribuida = $distHoyCat[$Categoria] ?? 0;
        } 
        // B) SI NO TIENE CATEGORÍA, USAMOS LOS ARREGLOS INDIVIDUALES
        else {
            $NombreReferencia = "Producto: " . $NombreProducto;
            $CantProduccion = $prodHoy[$NombreProducto] ?? 0;
            $CantMerma      = $mermasTotal[$NombreProducto] ?? 0;
            $CantYaDistribuida = $distHoy[$NombreProducto] ?? 0;
        }

        // -----------------------------------------------------------
        // 5. CÁLCULO FINAL
        // -----------------------------------------------------------
        
        // Sumamos Producción + Mermas (0 + X, o X + 0, o X + Y)
        $StockTotalDisponible = $CantProduccion + $CantMerma;

        // Si no hay NADA en ningún lado, detenemos
        if ($StockTotalDisponible == 0) {
            echo "⚠️ Error: No hay existencias registradas (Ni Producción ni Mermas) para <b>$NombreReferencia</b>.";
            return;
        }

        $DemandaTotal = $CantYaDistribuida + $CantidadSolicitada;

        // VALIDACIÓN DE CANTIDAD
        if ($StockTotalDisponible >= $DemandaTotal) {
            $modelSalidaMercancia->insert($formulario);
            echo "registrar";
        } else {
            echo "⚠️ Error: Excede existencias de <b>$NombreReferencia</b>.<br>";
            echo "Producción ($CantProduccion) + Mermas ($CantMerma) = <b>Total: $StockTotalDisponible</b><br>";
            echo "Solicitado Total: $DemandaTotal (Ya enviado: $CantYaDistribuida + Actual: $CantidadSolicitada)";
        }
    }

    

    private function validarformalmacen()
    {


        if ($this->request->getPost()) {
            $idAlmacen = $this->request->getPost("idAlmacen");
            $Fecha_de_Ingreso = $this->request->getPost("Fecha_de_Ingreso");
            $Cantidad_Ingresada = $this->request->getPost("Cantidad_Ingresada");
            $Medicion = $this->request->getPost("Tipo_Medicion");
        }
        if (
            isset($idAlmacen) && !empty($idAlmacen) &&
            isset($Fecha_de_Ingreso) && !empty($Fecha_de_Ingreso) &&
            isset($Cantidad_Ingresada) && !empty($Cantidad_Ingresada) &&
            isset($Medicion) && !empty($Medicion)

        ) {
            $validarformalmacen = array(
                "Almacen_idAlmacen" => $idAlmacen,
                "Fecha_de_Ingreso" => $Fecha_de_Ingreso,
                "Cantidad_Ingresada" => $Cantidad_Ingresada,
                "Tipo_Medicion" => $Medicion

            );
            // var_dump($formularioplanta);
            return $validarformalmacen;
        } else {
            echo "  ERROR EN EL CONTROLADOR POR LOS DATOS";
            return false;
        }
    }


    private function validarDistribucionUsuario()
    {
        if ($this->request->getPost()) {
            $id = $this->request->getPost("id");
            $producto = $this->request->getPost("producto");
            $cantidad = $this->request->getPost("cantidad");
            $nota = $this->request->getPost("nota");
            $seleccionado = $this->request->getPost("seleccionado");
        }

        if (
            isset($id) && !empty($id) &&
            isset($producto) && !empty($producto) &&
            isset($cantidad) && !empty($cantidad) &&
            isset($nota) &&
            isset($seleccionado)
        ) {
            $validarDistribucion = [
                "Salida_Mercancia_idSalida_Mercancia" => $id,
                //"Nombre_Producto" => $producto,
                //	"Cantidad_Salida" => $cantidad,
                "Nota" => $nota,
                "Confirmacion_Salida" => filter_var($seleccionado, FILTER_VALIDATE_BOOLEAN)
            ];

            return $validarDistribucion;
        } else {
            return false;
        }


    }

    private function validarformcorroboracion()
    {


        if ($this->request->getPost()) {
            $idAlmacen = $this->request->getPost("idAlmacen");
            $Referencias_Almacen_idReferencias_Almacen = $this->request->getPost("Referencias_Almacen_idReferencias_Almacen");
            $Fecha_edicion = $this->request->getPost("Fecha_edicion");
            $Cantidad_cambio_Existente = $this->request->getPost("Cantidad_cambio_Existente");
            $Motivo_del_Cambio = $this->request->getPost("Motivo_del_Cambio");
        }
        if (
            isset($idAlmacen) && !empty($idAlmacen) &&
            isset($Referencias_Almacen_idReferencias_Almacen) && !empty($Referencias_Almacen_idReferencias_Almacen) &&
            isset($Fecha_edicion) && !empty($Fecha_edicion) &&
            isset($Cantidad_cambio_Existente) && !empty($Cantidad_cambio_Existente) &&
            isset($Motivo_del_Cambio) && !empty($Motivo_del_Cambio)
        ) {
            $validarformalmacen = array(
                "Almacen_idAlmacen" => $idAlmacen,
                "Almacen_Referencias_Almacen_idReferencias_Almacen" => $Referencias_Almacen_idReferencias_Almacen,
                "Fecha_edicion" => $Fecha_edicion,
                "Cantidad_cambio_Existente" => $Cantidad_cambio_Existente,
                "Motivo_del_Cambio" => $Motivo_del_Cambio
            );
            // var_dump($formularioplanta);
            return $validarformalmacen;
        } else {
            echo "  ERROR EN EL CONTROLADOR POR LOS DATOS";
            return false;
        }
    }

    private function validarProducto()
    {


        if ($this->request->getPost()) {
            $Nombre_Producto = $this->request->getPost("Nombre_Producto");
            $Valor_produccion = $this->request->getPost("Valor_produccion");
            $Valor_Venta = $this->request->getPost("Valor_Venta");
            $Categoria = $this->request->getPost("Categoria");
        }


        if (
            isset($Nombre_Producto) && !empty($Nombre_Producto) &&
            isset($Valor_produccion) && !empty($Valor_produccion) &&
            isset($Valor_Venta) && !empty($Valor_Venta) &&
            isset($Categoria) && !empty($Categoria)

        ) {
            $validarformProducto = array(
                "Nombre_Producto" => $Nombre_Producto,
                "Valor_produccion" => $Valor_produccion,
                "Valor_Venta" => $Valor_Venta,
                "Categoria" => $Categoria
            );
            // var_dump($formularioplanta);
            return $validarformProducto;
        } else {
            echo "  ERROR EN EL CONTROLADOR POR LOS DATOS";
            return false;
        }
    }

    private function ValidarFormulario_Gastos()
    {


        if ($this->request->getPost()) {
            $Nombre_Producto = $this->request->getPost("Nombre_Producto");
            $Nombre_Producto_de_Almacen = $this->request->getPost("Nombre_Producto_de_Almacen");
            $Cantidad_Gasto = $this->request->getPost("Cantidad_Gasto");
        }


        if (
            isset($Nombre_Producto) && !empty($Nombre_Producto) &&
            isset($Nombre_Producto_de_Almacen) && !empty($Nombre_Producto_de_Almacen) &&
            isset($Cantidad_Gasto) && !empty($Cantidad_Gasto)

        ) {
            $validarformGasto = array(
                "Productos_idProductos" => $Nombre_Producto,
                "Almacen_idAlmacen" => $Nombre_Producto_de_Almacen,
                "Cantidad_uso" => $Cantidad_Gasto,
            );
            // var_dump($formularioplanta);
            return $validarformGasto;
        } else {
            echo "  ERROR EN EL CONTROLADOR POR LOS DATOS";
            return false;
        }
    }


    private function ValidarFormulario_productos_deseados()
    {


        if ($this->request->getPost()) {
            $Nombre_Producto = $this->request->getPost("Nombre_Producto");
            $Cantidad_a_producir = $this->request->getPost("Cantidad_a_producir");
        }


        if (
            isset($Nombre_Producto) && !empty($Nombre_Producto) &&
            isset($Cantidad_a_producir) && !empty($Cantidad_a_producir)

        ) {
            $fecha = $this->fecha();
            $validarformproductosdeseados = array(
                "Productos_idProductos" => $Nombre_Producto,
                "Cantidad_requerida" => $Cantidad_a_producir,
                "Fecha_Registro" => $fecha
            );
            // var_dump($formularioplanta);
            return $validarformproductosdeseados;
        } else {
            echo "  ERROR EN EL CONTROLADOR POR LOS DATOS";
            return false;
        }
    }


    private function ValidarFormulario_productos($idUser)
    {
        if ($this->request->getPost()) {
            $Nombre_Producto = $this->request->getPost("Nombre_Producto");
            $Cantidad_a_producir = $this->request->getPost("Cantidad_a_producir");
        }

        
        if (
            isset($Nombre_Producto) && !empty($Nombre_Producto) &&
            isset($Cantidad_a_producir) && !empty($Cantidad_a_producir) &&
            isset($idUser) && !empty($idUser)
        ) {
            $validarformproductosdeseados = array(
                "Productos_idProductos" => $Nombre_Producto,
                "Cantidad_Realizada" => $Cantidad_a_producir,
                "users_id" => $idUser
            );
            return $validarformproductosdeseados;
        } else {
            echo "  ERROR EN EL CONTROLADOR POR LOS DATOS";
            return false;
        }
    }


    private function validarDistribucion()
    {

        $FechaIdExiste = $this->FechaidExistente();
        if ($this->request->getPost()) {
            $Nombre_Producto = trim($this->request->getPost("Nombre_Producto"));
            $Nombre_Sucursal = trim($this->request->getPost("Nombre_Sucursal"));
            $Cantidad_Mandar = trim($this->request->getPost("Cantidad_Mandar"));
        }


        if (!empty($Nombre_Producto) && !empty($Nombre_Sucursal) && !empty($Cantidad_Mandar)) {


            $validarform = array(
                "Productos_idProductos" => $Nombre_Producto, // Nombre_Producto O CATEGORIA
                "Sucursales_idSucursales" => $Nombre_Sucursal,
                "Cantidad_Salida" => $Cantidad_Mandar,
                "Tabla_Produccion_Fecha_idTabla_Produccion" => $FechaIdExiste
            );

            return $validarform;
        } else {
            echo "❌ Error: Faltan campos obligatorios.";
            return false;
        }
    }

    private function ValidarFormulario_Predeterminado()
    {


        if ($this->request->getPost()) {
            $Nombre_Producto = $this->request->getPost("Nombre_Producto");
            $Predeterminado = $this->request->getPost("Predeterminado");

        }


        if (
            isset($Nombre_Producto) && !empty($Nombre_Producto) &&
            isset($Predeterminado) && !empty($Predeterminado)


        ) {
            $validarformPredeterminado = array(
                "Nombre_Producto" => $Nombre_Producto,
                "Can_Predeterminada" => $Predeterminado
            );
            // var_dump($formularioplanta);
            return $validarformPredeterminado;
        } else {
            echo "  ERROR EN EL CONTROLADOR POR LOS DATOS";
            return false;
        }
    }

    private function FechaidExistente()
    {
        $modeloTablaProduccionFecha = new TablaProduccionFecha();
        $fecha = $this->fecha();
        $FechaIdExiste = $modeloTablaProduccionFecha->UltimaFecha($fecha);
        return $FechaIdExiste;
    }


    private function ObtenerProduccionHoy($fecha)
    {

        //echo $fecha;
        $modeloTablaProduccionFecha = new TablaProduccionFecha();
        $productos = $modeloTablaProduccionFecha->ConsultarPorduccionRegistrada($fecha);
        //d($modeloTablaProduccionFecha->obtenerFecha($fecha));


        // Inicializar el arreglo para almacenar los totales
        $totales = [];
        foreach ($productos as $producto) {
            // Convertir Nombre_Producto a minúsculas para evitar duplicados por diferencia de mayúsculas
            $nombre = $producto['Nombre_Producto'];

            // Convertir Cantidad_Realizada a entero para poder sumar
            $cantidad = (int)$producto['Cantidad_Realizada'];

            // Sumar la cantidad realizada al total correspondiente
            if (isset($totales[$nombre])) {
                $totales[$nombre] += $cantidad;
            } else {
                $totales[$nombre] = $cantidad;
            }
        }

        // Mostrar los totales
        return $totales;
    }

    private function ObtenerProduccionHoyCategoria($fecha)
    {

        //echo $fecha;
        $modeloTablaProduccionFecha = new TablaProduccionFecha();
        $productos = $modeloTablaProduccionFecha->ConsultarPorduccionRegistrada($fecha);
        //d($modeloTablaProduccionFecha->obtenerFecha($fecha));


        // Inicializar el arreglo para almacenar los totales
        $totales = [];
        foreach ($productos as $producto) {
            // Convertir Nombre_Producto a minúsculas para evitar duplicados por diferencia de mayúsculas
            $nombre = $producto['Categoria'];

            // Convertir Cantidad_Realizada a entero para poder sumar
            $cantidad = (int)$producto['Cantidad_Realizada'];

            // Sumar la cantidad realizada al total correspondiente
            if (isset($totales[$nombre])) {
                $totales[$nombre] += $cantidad;
            } else {
                $totales[$nombre] = $cantidad;
            }
        }

        // Mostrar los totales
        return $totales;
    }


// YA SE OBTIENE DE QUE SUCURSAL SALE SOLO CHECAR QUE HAY UNA FUNCION IGUAL PERO CON DIFERENTE NOMBRE CHECAR
    private function ObtenerDistribucionHoy(){
        $modelSalidaMercancia = new SalidaMercancia();

        $ConsultaDistribucion = $modelSalidaMercancia->Buscartotales($this->FechaidExistente());

        d($ConsultaDistribucion);
        // Arreglo donde se guardarán las sumas por producto
        $totales = [];

        foreach ($ConsultaDistribucion as $producto) {
            $nombre = $producto['Nombre_Producto'];
            $cantidad = (int) $producto['Cantidad_Salida']; // Convertir la cantidad a entero

            // Verificar si el producto ya existe en el arreglo de totales
            if (isset($totales[$nombre])) {
                $totales[$nombre] += $cantidad; // Sumar la cantidad si el producto ya existe
            } else {
                $totales[$nombre] = $cantidad; // Si no existe, inicializarlo con la cantidad actual
            }
        }

        return $totales;
    }


    private function ObtenerDistribucionHoyCategoria(){
        $modelSalidaMercancia = new SalidaMercancia();

        $ConsultaDistribucion = $modelSalidaMercancia->Buscartotales($this->FechaidExistente());

        //d($ConsultaDistribucion);
        // Arreglo donde se guardarán las sumas por producto
        $totales = [];

        foreach ($ConsultaDistribucion as $producto) {
            $nombre = $producto['Categoria'];
            $cantidad = (int) $producto['Cantidad_Salida']; // Convertir la cantidad a entero

            // Verificar si el producto ya existe en el arreglo de totales
            if (isset($totales[$nombre])) {
                $totales[$nombre] += $cantidad; // Sumar la cantidad si el producto ya existe
            } else {
                $totales[$nombre] = $cantidad; // Si no existe, inicializarlo con la cantidad actual
            }
        }

        return $totales;
    }


    private function ObtenerDistribucionHoyporsucursal($sucursal){
        $modelSalidaMercancia = new SalidaMercancia();

        $ConsultaDistribucion = $modelSalidaMercancia->Buscartotalesconsucursal($this->FechaidExistente(),$sucursal);

        //d($ConsultaDistribucion);
        // Arreglo donde se guardarán las sumas por producto
        $totales = [];

        foreach ($ConsultaDistribucion as $producto) {
            $nombre = $producto['Nombre_Producto'];
            $cantidad = (int) $producto['Cantidad_Salida']; // Convertir la cantidad a entero

            // Verificar si el producto ya existe en el arreglo de totales
            if (isset($totales[$nombre])) {
                $totales[$nombre] += $cantidad; // Sumar la cantidad si el producto ya existe
            } else {
                $totales[$nombre] = $cantidad; // Si no existe, inicializarlo con la cantidad actual
            }
        }

        return $totales;
    }

    private function ObtenerDistribucionHoyporsucursalconid($sucursal){
        $modelSalidaMercancia = new SalidaMercancia();

        $ConsultaDistribucion = $modelSalidaMercancia->Buscartotalesconsucursal($this->FechaidExistente(),$sucursal);
        // consulta de la base de datos de la tabla Salida de mercancia por fecha y por sucursal, para obtener los idSalida_Mercancia

        //d($ConsultaDistribucion);

        return $ConsultaDistribucion;
    }


 public function ObtenerId_User()
{
    // 1. Verificar si la librería de autenticación tiene un ID
    $authId = auth()->id();

    if (!$authId) {
        return false; // No hay sesión iniciada
    }

    $userModel = new UserModel();
    $userData = $userModel->find($authId);

    // 2. Verificar si la consulta a la BD devolvió algo (no es null)
    if ($userData) {
        return $userData->id;
    }

    // Si llegamos aquí, es que no se encontró el usuario
    return false;
}


    // AQUI TENGO UN PROBLEMA CON LOS ID DE LOS USUARIOS HAY QUE CHECAR CUAL ES DE CUAL //
    //AQUI LO QUE PREDOMINA ES LA TABLA DE SUCURSALES YA QUE ESA DETERMINA EL USUARIO AL QUE PERTENECE //

    public function Vista_Confirmacion_Usuario(){

        $TablaMercanciaSucursal = new MercanciaSucursal();
        $Empleado = new Empleados();

        $idUser= $this->ObtenerId_User(); // obtengo el id User de la Sesion

        $ConsultaUsuario = $Empleado->BuscarNombre($idUser); // obtenemos el nombre de la sucursal y del usuario

        var_dump($ConsultaUsuario);

        $NombredeSucursaldeUsuario = $ConsultaUsuario['idSucursales']; // esta variable describe a que sucursal pertenece el usuario logeado

        d($this->ObtenerDistribucionHoyporsucursal($NombredeSucursaldeUsuario));
        // obtenemos la cantidad de distribucion por Sucursal y fecha actual solo obtenemos los datos de nombre del producto
        //y la cantidad que se hizo para esa sucursal en suma o en total



        d($this->ObtenerDistribucionHoyporsucursalconid($NombredeSucursaldeUsuario));
        $arraydistribucion = $this->ObtenerDistribucionHoyporsucursalconid($NombredeSucursaldeUsuario);
        // este arreglo me da toda la tabla de distribuciones por fecha actual y por Usuario dependiendo de que sucursal este el usuario logeado
        // la diferencia a la de arriba es que aqui no lo suma, y te entrega los registros por separado por si el area de distribucion hizo mas de un registro de distrubucion
        // osea que 100 conchas se mandaron a x => sucursal, y hace un segundo registro con el mismo producto y la misma sucursal, se generarian 2 ids y aqui lo muestra los 2 por separado, sin suma uno de 100 y el otro de lo que hayan registrado.



        d($TablaMercanciaSucursal->FuncionBusqueda($this->FechaidExistente(),$NombredeSucursaldeUsuario));
        $arrayconfirmados = $TablaMercanciaSucursal->FuncionBusqueda($this->FechaidExistente(),$NombredeSucursaldeUsuario);

        // aqui consulto de la tabla mercancia_sucursal la que registra las confirmaciones ya hechas, se guia de la fecha actual
        // cosnsidero que debe de tener igual un filtro de sucursal, por usuario, por que de otra forma me va a devolver todos los inserts


        //array_column: Extrae los valores de idSalida_Mercancia de arrayconfirmados y los almacena en $idsToRemove.
        //array_filter: Recorre cada elemento de arraydistribucion y verifica si su idSalida_Mercancia no está en $idsToRemove. Si no está, se conserva el elemento.
        //array_values: Reindexa el array resultante para mantener índices consecutivos.
        //Resultado: Devuelve un array limpio con los elementos filtrados
        // Validar estructura
        if (is_array($arraydistribucion) && is_array($arrayconfirmados)) {

            // Extraer los IDs de arrayB para comparar
            $idsToRemove = array_column($arrayconfirmados, "idSalida_Mercancia");
            // Filtrar arrayA para excluir elementos que estén en arrayB
            $arrayFiltered = array_filter($arraydistribucion, function($item) use ($idsToRemove) {
                return isset($item["idSalida_Mercancia"]) && !in_array($item["idSalida_Mercancia"], $idsToRemove);
            });
            // Reindexar el arreglo filtrado
            $arrayFiltered = array_values($arrayFiltered);
            d($arrayFiltered);

        } else {
            echo "Error: uno de los datos no es un arreglo válido.";
        }


        $vistaConfirmacion =
            view('html/Cabecera') .
            view('html/menuvendedoras') .
            view('html/Confirmacion', array('DataDistribucion' => $arrayFiltered));

        return $vistaConfirmacion;
    }



    public function Registrar_mercancia_sucursal(){

        $TablaMercanciaSucursal = new MercanciaSucursal();

        var_dump($this->validarDistribucionUsuario());
        $formtabla = $this->validarDistribucionUsuario();

        $TablaMercanciaSucursal->insert($formtabla);


    }

    public function Vista_Produccion_Registrado()
    {
        $datos_Productos = new Productos();
        $datos_Sucursales = new TablaSucursales();
        
        $select_Productos = $datos_Productos->Buscar_productosyCategorias();

        $select_Productos = array_map(function($producto) {
            return $producto['Categoria'] ?? $producto['Nombre_Producto'];
        }, $select_Productos);

        $select_Productos = array_unique($select_Productos);
        
        $select_Sucursales = $datos_Sucursales->Buscar_Sucursales();
        $idusuario = $this->ObtenerId_User();

        // 1. OBTENER LOS DATOS EN VARIABLES
        $datosProduccionHoy = $this->ObtenerProduccionHoy($this->fecha());
        $datosProduccionHoyPorCategoria = $this->ObtenerProduccionHoyCategoria($this->fecha());
        $datosMermasHoy = $this->ObtenerMermasHoyCategoria(); 
        $distHoyCat = $this->ObtenerDistribucionHoyCategoria();
        
        $modelSalidaMercancia = new SalidaMercancia();
        $ConsultaDistribucion = $modelSalidaMercancia->Buscartotales($this->FechaidExistente());
        
        $distribucionProductos = $this->ObtenerDistribucionHoy();

        // 🌟 LA MAGIA (NIVEL DIOS): Creamos una función segura para normalizar
        // Esto soluciona el problema con acentos, la "ñ" y los espacios ocultos
        $normalizarLlaves = function($arreglo) {
            $nuevoArreglo = [];
            if (is_array($arreglo)) {
                foreach ($arreglo as $key => $value) {
                    // mb_strtoupper convierte a mayúsculas respetando el UTF-8 (acentos y ñ)
                    $llaveLimpia = mb_strtoupper(trim($key), 'UTF-8');
                    $nuevoArreglo[$llaveLimpia] = $value;
                }
            }
            return $nuevoArreglo;
        };

        // Aplicamos la normalización segura a todos nuestros arreglos
        $datosProduccionHoy = $normalizarLlaves($datosProduccionHoy);
        $datosProduccionHoyPorCategoria = $normalizarLlaves($datosProduccionHoyPorCategoria);
        $datosMermasHoy = $normalizarLlaves($datosMermasHoy);
        $distHoyCat = $normalizarLlaves($distHoyCat);
        $distribucionProductos = $normalizarLlaves($distribucionProductos);

        // ESTE PEDAZO DE CODIGO REALIZA LA SUMA DE Disponible Real
        $CategoriasConStockReal = [];

        foreach ($select_Productos as $item) { 
            // También normalizamos la búsqueda de forma segura
            $itemKey = mb_strtoupper(trim($item), 'UTF-8');

            // 2. PRODUCCIÓN
            $produccion = $datosProduccionHoyPorCategoria[$itemKey] ?? ($datosProduccionHoy[$itemKey] ?? 0);

            // 3. MERMAS
            $mermas = $datosMermasHoy[$itemKey] ?? 0;

            // 4. DISTRIBUCIÓN
            $distribuido = $distHoyCat[$itemKey] ?? ($distribucionProductos[$itemKey] ?? 0);

            // NIVEL PRO: Cálculo del stock
            $stockReal = ($produccion + $mermas) - $distribuido;

            if ($stockReal < 0) {
                $stockReal = 0;
            }

            $CategoriasConStockReal[] = [
                'Categoria' => $item, // Conserva el nombre original intacto
                'StockReal' => $stockReal
            ];
        }

        // var_dump($CategoriasConStockReal); // <-- Descomenta para confirmar los datos

        $Vista_Produccion_Registrado =
            view('html/Cabecera') .
            view('html/menudistribucion') .
            view('html/RegistroDistrubucion', array(
                'Productos' => $select_Productos, 
                'Sucursales' => $select_Sucursales,
                'Distribucion' => $this->ObtenerDistribucionHoy(),
                'ProduccionHoy'  => $datosProduccionHoy, 
                'MermasHoy'      => $datosMermasHoy,     
                'ProduccionHoyPorCategoria' => $datosProduccionHoyPorCategoria, 
                'CategoriasConStockReal' => $CategoriasConStockReal, 
                'ConsultaDistribucion' => $ConsultaDistribucion,
            ));

        return $Vista_Produccion_Registrado;
    }






// --- NUEVAS FUNCIONES PARA ELIMINAR DISTRIBUCIÓN ---

    public function VistaEliminarDistribucion()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaHoy = date("Y-m-d");

        // Obtenemos el ID de la producción de hoy
        $modeloFechas = new TablaProduccionFecha();
        $registroFecha = $modeloFechas->obtenerFecha($fechaHoy);
        
        $idTablaProduccion = null;
        if ($registroFecha && isset($registroFecha['idTabla_Produccion'])) {
            $idTablaProduccion = $registroFecha['idTabla_Produccion'];
        }

        // Traemos la lista de lo que se ha enviado hoy
        $salidaModel = new SalidaMercancia();
        $datosDistribucion = $salidaModel->ObtenerDistribucionParaEliminar($idTablaProduccion);

        $data = [
            'fechaHoy' => $fechaHoy,
            'distribuciones' => $datosDistribucion
        ];

        return view('html/Cabecera') .
               view('html/menudistribucion') .
               view('html/VistaEliminarDistribucion', $data);
    }

public function EliminarRegistroDistribucion()
    {
        // Atrapamos el ID oculto que nos manda el formulario de la vista
        $idSalida = $this->request->getPost('idSalida'); 
        
        if (!empty($idSalida)) {
            $salidaModel = new SalidaMercancia();
            $salidaModel->delete($idSalida);
        }

        // Redirigimos de vuelta a la vista para que la tabla se actualice
        return redirect()->to('/VistaEliminarDistribucion'); 
        // Nota: Ajusta '/Home/VistaEliminarDistribucion' si tienes una ruta personalizada para esa vista
    }
    










    public function Vista_CantidadPredeterminada()
    {
        $datos_Productos = new Productos();
        $select_Productos = $datos_Productos->Buscar_productosyCategorias();
        $select_Productos = array_map(function($producto) {
            return $producto['Categoria'] ?? $producto['Nombre_Producto'];
        }, $select_Productos);
        $select_Productos = array_unique($select_Productos);
        //d($select_Productos);

        $vistaProduccionDeseada =
            view('html/Cabecera') .
            view('html/menu') .
            view('html/CambiarValorPredeterminado', array('Productos' => $select_Productos));//,'ConsultaPedidos' => ));

        return $vistaProduccionDeseada;


    }

    public function CambiarValorPredeterminado()
    {
        $Cantidad = $this->ValidarFormulario_Predeterminado()['Can_Predeterminada'];
        $Nombre_Producto = $this->ValidarFormulario_Predeterminado()['Nombre_Producto'];
        $modelProducto = new Productos();

        $modelProducto->CambiarValorPredeterminado($Nombre_Producto,$Nombre_Producto,$Cantidad);


    }



    public function VistaEliminarRegistroProduccion()
    {
        $modeloTablaProduccionFechaHasProductos = new TablaProduccionFechaHasProductos();
        //  $modelproduccion_productos = new Produccion_productos();
        $modeloTablaProduccionFecha = new TablaProduccionFecha();
        $fecha = $this->fecha();
        $idfecha = $modeloTablaProduccionFecha->obtenerFecha($fecha);


        $datosTablaProduccionFechaHasProductos = $modeloTablaProduccionFechaHasProductos->ConsultarPorduccionRegistrada($idfecha);

        //d($datosTablaProduccionFechaHasProductos);

        // Eliminar primero los detalles del pedido
        //  $modelproduccion_productos->where('idProduccion_Productos', $datosTablaProduccionFechaHasProductos[0]['idProduccion_Productos'])->delete();

        // Luego eliminar el pedido
        //$modeloTablaProduccionFechaHasProductos->delete($datosTablaProduccionFechaHasProductos[0]['id']);


        $vistaEliminarRegistroProduccion =
            view('html/Cabecera') .
            view('html/menuPanadero') .
            view('html/EliminarRegistroProduccion', array(
                'TablaProduccionFechaHasProductos' => $datosTablaProduccionFechaHasProductos
            ));

        return $vistaEliminarRegistroProduccion;
    }


    public function SeleccionarYEliminarPanadero()
    {
        $modelproduccion_productos = new Produccion_productos();
        $modeloTablaProduccionFechaHasProductos = new TablaProduccionFechaHasProductos();
        $modelAlmacen = new Almacen();

        if ($this->request->getPost()) {
            $idCelda = $this->request->getPost("idCelda");
            $Nombre_Producto = $this->request->getPost("nombre");
            $Cantidad_Realizada = $this->request->getPost("cantidad");
            $IdProducto = $this->request->getPost("idProducto");
        }

        $datos_Productos = new Productos();
        $Datobuscar = $datos_Productos->Buscar_productos_id($IdProducto);
        $CantidadUso = $datos_Productos->BuscarCantidadUso($Datobuscar);
        $tamañodearreglo = count($CantidadUso);

        $datosTablaProduccionFechaHasProductos = $modeloTablaProduccionFechaHasProductos->ConsultarPorduccionRegistradaPorID($idCelda);

        if ($datosTablaProduccionFechaHasProductos) {

            $modelproduccion_productos->where('idProduccion_Productos', $datosTablaProduccionFechaHasProductos['idProduccion_Productos'])->delete();
            $modeloTablaProduccionFechaHasProductos->delete($datosTablaProduccionFechaHasProductos['id']);

            for ($i = 0; $i < $tamañodearreglo; $i++) {
                $multiplicacion = ($CantidadUso[$i]['Cantidad_uso']) * (-$Cantidad_Realizada);
                $restaalmacen = ($CantidadUso[$i]['Cantidad_Existente'] * $CantidadUso[$i]['Cantidad_medida']) - ($multiplicacion);
                $pasarmedida = ($restaalmacen / $CantidadUso[$i]['Cantidad_medida']);

                $data = [
                    'Cantidad_Existente' => $pasarmedida
                ];

                $modelAlmacen->where('idAlmacen', $CantidadUso[$i]['idAlmacen'])->set($data)->update();
            }
        } else {
            echo "Error: No se pudo eliminar la celda.";
        }
    }












    public function GenerarReporteProduccion()
    {
//////AQUI VAMOS A OBTENER TODOS LOS USUARIOS QUE SON PANADEROS
        $Panaderos = new auth_groups_users();
        $select_Panaderos = $Panaderos->Buscar_soloPanaderos();
     //   d($select_Panaderos);
////////////////////////////////////////////////////////////////////////

        $Empleado = new Empleados();

        $idUser= $this->ObtenerId_User(); // obtengo el id User de la Sesion

        $ConsultaUsuario = $Empleado->BuscarNombre($idUser); // obtenemos el nombre de la sucursal y del usuario
        $nombreUsuario = $ConsultaUsuario['Nombre']; // Extraer solo el nombre del usuario

         $vistaProduccionDeseada =
            view('html/Cabecera') .
            view('html/menu') .
            view('html/GenerarReportePagoPanadero', array('DataNombre' => $nombreUsuario,'Panaderos' => $select_Panaderos));//,'ConsultaPedidos' => ));

        return $vistaProduccionDeseada;




        

        }


public function ConsultarPagoPanadero()
{
    if ($this->request->getPost()) {
        $idPanadero = $this->request->getPost("Panadero");
    }

    $FechActual = $this->fecha();
    $modeloTablaProduccionFecha = new TablaProduccionFecha();
    $fechas = $modeloTablaProduccionFecha->obtenerUltimasFechasIDs($FechActual);
    
    $resultado = $this->contarSemanasActuales($fechas);
    $modeloTablaProduccionFechaHasProductos = new TablaProduccionFechaHasProductos();

    $respuesta = [];

    foreach ($resultado as $item) {
        $Idconsulta = $item['idTabla_Produccion'];
        $datosProductos = $modeloTablaProduccionFechaHasProductos->obtenerProductosPorProduccion($Idconsulta, $idPanadero);

        $total = 0;
        foreach ($datosProductos as $producto) {
            if (isset($producto['Valor_produccion']) && isset($producto['Cantidad_Realizada'])) {
                $total += $producto['Valor_produccion'] * $producto['Cantidad_Realizada'];
            }
        }

        $respuesta[] = [
            'dia' => $item['Día de la semana'],
            'fecha' => $item['Fecha'],
            'total' => $total,
            'productos' => $datosProductos
        ];
    }

    return $this->response->setJSON($respuesta);
}



private function contarSemanasActuales($fechas) {
    // $fechas debe ser un array de strings tipo 'YYYY-MM-DD'
    $semanas = [];
    $semanaActual = (new \DateTime($this->fecha()))->format('W');
    // Array de días en español
    $dias_es = [
        'Monday' => 'Lunes',
        'Tuesday' => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday' => 'Jueves',
        'Friday' => 'Viernes',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo'
    ];
    foreach ($fechas as $item) {
        $fechaStr = $item['Fecha_de_Produccion']; // Extraer solo la fecha
        $fecha = new \DateTime($fechaStr);
        $numSemana = $fecha->format('W');
        if ($numSemana == $semanaActual) {
            $dia_en = $fecha->format('l');
            $dia_es = $dias_es[$dia_en] ?? $dia_en;
            $semanas[] = [
                'Fecha' => $fechaStr,
                'Día de la semana' => $dia_es,
                'Año' => $fecha->format('Y'),
                'Número de semana' => $numSemana,
                'idTabla_Produccion' => $item['idTabla_Produccion'] // Rescatar el id
            ];
        }
    }
    return  $semanas;
}






private function ObtenerMermasHoyCategoria()
    {
        // 1. Instanciamos el modelo de mermas
        $ListaMermas = new MermasModel();
        
        // 2. Obtenemos el ID del último lote
        $IdUltimaFecha = (int)$ListaMermas->BuscarNumeroMasAlto();

        $totales = [];

        // 3. Validamos si existe ese ID
        if ($IdUltimaFecha) {
            
            // Obtenemos las mermas (Tu JOIN ya trae Categoria y Nombre_Producto)
            $ListaMermasActuales = $ListaMermas->BuscarMermasActuales($IdUltimaFecha);

            if (!empty($ListaMermasActuales)) {
                
                foreach ($ListaMermasActuales as $merma) {
                    
                    $ClaveParaSumar = null;

                    // CONDICIÓN 1: Si tiene Categoría, usamos esa.
                    if (!empty($merma['Categoria'])) {
                        $ClaveParaSumar = trim($merma['Categoria']);
                    } 
                    // CONDICIÓN 2: Si NO tiene Categoría (es null o vacío), usamos el Nombre del Producto.
                    elseif (!empty($merma['Nombre_Producto'])) {
                        $ClaveParaSumar = trim($merma['Nombre_Producto']);
                    }

                    // Si logramos definir una clave (ya sea categoría o nombre), procedemos a sumar
                    if ($ClaveParaSumar !== null) {
                        
                        $cantidad = (int)$merma['Conteo_Merma']; 

                        // Sumamos al acumulado
                        if (isset($totales[$ClaveParaSumar])) {
                            $totales[$ClaveParaSumar] += $cantidad;
                        } else {
                            $totales[$ClaveParaSumar] = $cantidad;
                        }
                    }
                }
            }
        }

        // Retorna mezcla de categorías y productos sueltos
        // Ej: ['CONCHAS' => 20, 'BOLILLO' => 100, 'MANTECA' => 5]
        return $totales;
    }

    public function Error_401()
    {
        return view('html/Cabecera') .
               view('html/error');
    }

public function Dasboard()
    {
     date_default_timezone_set('America/Mexico_City');
        
        // 1. Recibimos la fecha del formulario. Si no hay, usamos la de hoy.
        $fechaSeleccionada = $this->request->getPost('fecha_reporte');
        if (empty($fechaSeleccionada)) {
            $fechaSeleccionada = date("Y-m-d");
        }

        // 2. Buscamos si existe un ID de producción para esa fecha elegida
        // Usamos tu modelo que ya tiene la función obtenerFecha()
        $modeloFechas = new TablaProduccionFecha();
        $registroFecha = $modeloFechas->obtenerFecha($fechaSeleccionada);
        
        // Extraemos el ID. Si no hay registro ese día, lo dejamos como null
        $idTablaProduccion = null;
        if ($registroFecha && isset($registroFecha['idTabla_Produccion'])) {
            $idTablaProduccion = $registroFecha['idTabla_Produccion'];
        }

        // 3. Consultamos el modelo
        $salidaModel = new SalidaMercancia();

        $data = [
            'fechaHoy' => $fechaSeleccionada, // Mandamos la fecha elegida a la vista
            'reporteDiario' => $salidaModel->ReporteDiarioDashboard($idTablaProduccion),
        ];

        return view('html/Cabecera') .
               view('html/menu') .
               view('html/VistaReportes', $data);
    }
}
