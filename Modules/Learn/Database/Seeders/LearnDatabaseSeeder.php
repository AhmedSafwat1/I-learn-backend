<?php

namespace Modules\Learn\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Learn\Database\Seeders\SubjectTableSeeder;

class LearnDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SubjectTableSeeder::class);
    }
}
