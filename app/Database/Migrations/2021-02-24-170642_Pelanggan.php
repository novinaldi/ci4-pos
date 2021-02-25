<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'pel_kode' => [
				'type' => 'int',
				'constraint' => '11',
				'auto_increment' => true,
			],
			'pel_nama' => [
				'type' => 'varchar',
				'constraint' => '100',
				'null' => false
			],
			'pel_alamat' => [
				'type' => 'text'
			],
			'pel_telp' => [
				'type' => 'char', 'constraint' => '20'
			]
		]);

		$this->forge->addKey('pel_kode', true);
		$this->forge->createTable('pelanggan');
	}

	public function down()
	{
		$this->forge->dropTable('pelanggan');
	}
}