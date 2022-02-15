<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUserAddFoto extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users',[
            'foto varchar(128)'
        ]);
    }

    public function down()
    {
        //
    }
}
