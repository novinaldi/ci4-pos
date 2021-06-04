<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembelian extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'beli_faktur' => [
				'type'		=> 'char',
				'constraint' => '20',
				'null'		=> false
			],
			'beli_tgl' => [
				'type'		=> 'date',
				'null'		=> false
			],
			'beli_jenisbayar' => [
				'type' => 'enum',
				'constraint' => ['T', 'K'],
				'default' => 'T'
			],
			'beli_supkode' => [
				'type' => 'int',
				'constraint' => '11',
			],
			'beli_dispersen' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'beli_disuang' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'beli_totalkotor' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'beli_totalbersih' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
		]);

		$this->forge->addPrimaryKey('beli_faktur');
		$this->forge->addForeignKey('beli_supkode', 'supplier', 'sup_kode', 'cascade');
		$this->forge->createTable('pembelian');
	}

	public function down()
	{
		$this->forge->dropTable('pembelian');
	}
}