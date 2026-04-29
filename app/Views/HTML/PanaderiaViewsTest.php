<?php

namespace App\Views;

use CodeIgniter\Test\CIUnitTestCase;

class PanaderiaViewsTest extends CIUnitTestCase
{
    /**
     * Test for Corroborar.php
     * Verifies that the inventory corroboration card renders with provided data.
     */
    public function testCorroborarViewRendersData()
    {
        $data = [
            'datos' => [
                [
                    'imagen_ref' => 'http://example.com/harina.jpg',
                    'Nombre_Materia' => 'Harina de Trigo',
                    'Cantidad_Existente' => 50,
                    'Medida' => 'Sacos',
                    'Cantidad_medida' => 20,
                    'Tipo_medicion' => 'Kg',
                    'idAlmacen' => 101,
                    'Referencias_Almacen_idReferencias_Almacen' => 5
                ]
            ]
        ];

        $result = view('html/Corroborar', $data);

        // Check for specific product details in the HTML output
        $this->assertStringContainsString('Harina de Trigo', $result);
        $this->assertStringContainsString('50', $result);
        $this->assertStringContainsString('Sacos', $result);
        $this->assertStringContainsString('value="101"', $result);
        
        // Verify the corroboration form exists
        $this->assertStringContainsString('id="Formulario_Corroboracion"', $result);
    }

    /**
     * Test for ProduccionDeseada.php
     * Verifies that the production dashboard renders orders and production goals.
     */
    public function testProduccionDeseadaViewRendersOrdersAndMeta()
    {
        $data = [
            'Fecha' => '20 de Marzo 2026',
            'ConsultaPedidos' => [
                'Pastel de Chocolate' => 5,
                'Conchas Vainilla' => 20
            ],
            'datos' => [
                [
                    'Nombre_Producto' => 'Bolillo',
                    'Cantidad_requerida' => 1000
                ]
            ]
        ];

        $result = view('html/ProduccionDeseada', $data);

        // Verify Date Header
        $this->assertStringContainsString('20 de Marzo 2026', $result);

        // Verify Orders List
        $this->assertStringContainsString('Pastel de Chocolate', $result);
        $this->assertStringContainsString('5 pzs', $result);

        // Verify Production Meta Table
        $this->assertStringContainsString('Bolillo', $result);
        $this->assertStringContainsString('1000', $result);
    }

    /**
     * Test for RegistroDistrubucion.php
     * Checks that the distribution form selects populate correctly.
     */
    public function testRegistroDistribucionRendersOptions()
    {
        $data = [
            'CategoriasConStockReal' => [
                ['Categoria' => 'Pan Dulce', 'StockReal' => 50],
                ['Categoria' => 'Pasteles', 'StockReal' => 0] // Should be disabled
            ],
            'Sucursales' => [
                ['idSucursales' => 1, 'NombreSucursal' => 'Sucursal Centro']
            ],
            'ConsultaDistribucion' => [],
            'Distribucion' => [],
            'ProduccionHoy' => [],
            'MermasHoy' => []
        ];

        $result = view('html/RegistroDistrubucion', $data);

        // Check valid option
        $this->assertStringContainsString('Pan Dulce', $result);
        $this->assertStringContainsString('(Disponible: 50)', $result);

        // Check disabled option logic
        $this->assertStringContainsString('disabled', $result);

        // Check Sucursal option
        $this->assertStringContainsString('Sucursal Centro', $result);
    }

    /**
     * Test for menuPanadero.php handling empty notifications.
     */
    public function testMenuPanaderoStructure()
    {
        $result = view('html/menuPanadero');
        $this->assertStringContainsString('Aurorita', $result);
        $this->assertStringContainsString('id="contador-notificaciones"', $result);
    }
}