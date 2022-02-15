<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterNews extends Migration
{
    public function up()
    {
        $this->forge->addColumn('news',[
            'slug varchar(100) unique'
        ]);
    }

    public function down()
    {
        //
    }
}
