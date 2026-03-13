<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSucursalToMermas extends Migration
{
    public function up()
    {
        // 1. Agregamos la columna usando SQL directo para evitar el error del punto en "basepanav3.12"
        $this->db->query('ALTER TABLE `mermas` ADD `Sucursales_idSucursales` INT(11) NULL AFTER `users_id`;');

        // 2. Agregamos la relación (Llave foránea)
        $this->db->query('
            ALTER TABLE `mermas` 
            ADD CONSTRAINT `fk_mermas_sucursales` 
            FOREIGN KEY (`Sucursales_idSucursales`) 
            REFERENCES `sucursales`(`idSucursales`) 
            ON DELETE RESTRICT 
            ON UPDATE CASCADE;
        ');
    }

    public function down()
    {
        // En caso de rollback, eliminamos primero la llave foránea y luego la columna
        $this->db->query('ALTER TABLE `mermas` DROP FOREIGN KEY `fk_mermas_sucursales`;');
        $this->db->query('ALTER TABLE `mermas` DROP COLUMN `Sucursales_idSucursales`;');
    }
}