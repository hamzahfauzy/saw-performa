<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitLbsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'   => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'tahun_masuk' => ['type' => 'VARCHAR', 'constraint' => 100],
            'semester_berjalan' => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_mahasiswa');

        $this->forge->addField([
            'id'            => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'bobot' => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_kriteria');

        $this->forge->addField([
            'id'            => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'mahasiswa_id' => ['type' => 'BIGINT', 'unsigned' => true],
            'kriteria_id'   => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'nilai'    => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('mahasiswa_id', 'tb_mahasiswa', 'id', '', 'RESTRICT', 'fk_tb_penilaian_mahasiswa_id');
        $this->forge->addForeignKey('kriteria_id', 'tb_kriteria', 'id', '', 'RESTRICT', 'fk_tb_penilaian_kriteria_id');
        $this->forge->createTable('tb_penilaian');
    }

    public function down()
    {
        $this->forge->dropTable('tb_mahasiswa');
        $this->forge->dropTable('tb_kriteria');
        $this->forge->dropTable('tb_penilaian');
    }
}
