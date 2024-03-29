<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(GuruSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JurusanSeeder::class);
        $this->call(KandidatSeeder::class);
        $this->call(KelasSeeder::class);
    }
}
