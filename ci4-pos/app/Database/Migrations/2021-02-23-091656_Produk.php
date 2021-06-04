<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'kodebarcode'          => [
				'type'           => 'char',
				'constraint'     => '50',
			],
			'namaproduk'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'produk_satid' => [
				'type' => 'int',
				'constraint' => '11'
			],
			'produk_katid' => [
				'type' => 'int',
				'constraint' => '11'
			],
			'stok_tersedia' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'harga_beli' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'harga_jual' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			]
		]);
		$this->forge->addKey('kodebarcode', true);
		$this->forge->addForeignKey('produk_satid', 'satuan', 'satid', 'cascade');
		$this->forge->addForeignKey('produk_katid', 'kategori', 'katid', 'cascade');
		$this->forge->createTable('produk');
	}

	public function down()
	{
		$this->forge->dropTable('produk');
	}
}