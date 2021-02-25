<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Supplier extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'sup_kode' => [
				'type' => 'int',
				'constraint' => '11',
				'auto_increment' => true,
			],
			'sup_nama' => [
				'type' => 'varchar',
				'constraint' => '100',
				'null' => false
			],
			'sup_alamat' => [
				'type' => 'text'
			],
			'sup_telp' => [
				'type' => 'char', 'constraint' => '20'
			]
		]);

		$this->forge->addKey('sup_kode', true);
		$this->forge->createTable('supplier');
	}

	public function down()
	{
		$this->forge->dropTable('supplier');
	}
}