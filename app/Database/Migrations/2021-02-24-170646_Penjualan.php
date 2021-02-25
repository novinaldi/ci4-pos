<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjualan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'jual_faktur' => [
				'type'		=> 'char',
				'constraint' => '20',
				'null'		=> false
			],
			'jual_tgl' => [
				'type'		=> 'date',
				'null'		=> false
			],
			'jual_pelkode' => [
				'type' => 'int',
				'constraint' => '11',
			],
			'jual_dispersen' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'jual_disuang' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'jual_totalkotor' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'jual_totalbersih' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			]
		]);

		$this->forge->addPrimaryKey('jual_faktur');
		$this->forge->addForeignKey('jual_pelkode', 'pelanggan', 'pel_kode', 'cascade');
		$this->forge->createTable('penjualan');
	}

	public function down()
	{
		$this->forge->dropTable('penjualan');
	}
}