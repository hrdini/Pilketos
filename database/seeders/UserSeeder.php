<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 100; $i++){
 
    		DB::table('users')->insert([
    			'nama' => $faker->name,
    			'nisn' => $faker->numerify('##########'),
                'nis' => $faker->numerify('#####'),
    			'kelas' => $faker->numberBetween(1,3),
                'jurusan' => $faker->numberBetween(1,6)
    		]);
 
    	}
    }
}
