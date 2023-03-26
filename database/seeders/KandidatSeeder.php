<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 3; $i++){
 
    		DB::table('kandidats')->insert([
            'gambar'=> $faker->imageUrl,
            'nama_ketua'=> $faker->name,
            'ketua_id'=> $faker->numberBetween(1,6),
            'nama_wakil'=> $faker->name,
            'wakil_id'=> $faker->numberBetween(1,6),
            'visi'=> $faker->text,
            'misi'=> $faker->text,
            'periode'=> 2023
    		]);
 
    	}
    }
}
