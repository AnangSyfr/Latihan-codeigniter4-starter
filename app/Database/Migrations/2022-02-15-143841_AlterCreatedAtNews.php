<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCreatedAtNews extends Migration
{
    public function up()
    {
        $this->forge->addColumn('news',[
            'created_at datetime default current_timestamp', 
        ]);
    }

    public function down()
    {
        //
    }
}
