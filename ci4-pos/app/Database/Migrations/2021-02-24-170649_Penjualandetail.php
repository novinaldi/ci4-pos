<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjualandetail extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'detjual_id' => [
				'type'		=> 'bigint',
				'constraint' => '11',
				'auto_increment' => true,
			],
			'detjual_faktur' => [
				'type'		=> 'char',
				'constraint' => '20',
			],
			'detjual_kodebarcode' => [
				'type'		=> 'char',
				'constraint' => '50',
			],
			'detjual_hargabeli' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'detjual_hargajual' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'detjual_jml' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'detjual_subtotal' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			]
		]);

		$this->forge->addPrimaryKey('detjual_id');
		$this->forge->addForeignKey('detjual_faktur', 'penjualan', 'jual_faktur', 'cascade');
		$this->forge->addForeignKey('detjual_kodebarcode', 'produk', 'kodebarcode', 'cascade');
		$this->forge->createTable('penjualan_detail');
	}

	public function down()
	{
		$this->forge->dropTable('penjualan_detail');
	}
}