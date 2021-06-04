<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Satuan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'satid'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'satnama'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			]
		]);
		$this->forge->addKey('satid', true);
		$this->forge->createTable('satuan');
	}

	public function down()
	{
		$this->forge->dropTable('satuan');
	}
}