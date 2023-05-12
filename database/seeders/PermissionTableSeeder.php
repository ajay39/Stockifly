<?php

namespace Database\Seeders;

use App\Classes\PermsSeed;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        PermsSeed::seedPermissions();
    }
}
